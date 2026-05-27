# Deployment guide (VPS bootstrap)

End-to-end instructions to bring a fresh Ubuntu VPS to a running livo.ink stack:
- `admin.livo.ink` — PHP CodeIgniter admin + game API
- `socket.livo.ink` — Node.js socket.io + REST API (port 3060)
- `games.livo.ink` — static WebGL build + APK + iOS install profile
- `livo.ink` + `www.livo.ink` — install landing page

Tested on Ubuntu 22.04 LTS (Jammy), kernel 5.15. Other Debian-family distros should work with minor command tweaks.

> **Convention** — replace `livo.ink` with your own domain throughout if you're forking. The same instructions work for any apex domain.

---

## 0. Prerequisites

- Ubuntu 22.04 VPS, root or sudo access
- Minimum **2 GB RAM, 2 vCPU, 25 GB disk**. The Unity WebGL build + APK alone is ~100 MB. The PHP `uploads/` directory grows with users.
- A registered domain. Point these A records to the VPS public IP:
  ```
  livo.ink            A  <vps-ip>
  www.livo.ink        A  <vps-ip>
  admin.livo.ink      A  <vps-ip>
  socket.livo.ink     A  <vps-ip>
  games.livo.ink      A  <vps-ip>
  ```
  Verify with `dig +short admin.livo.ink @1.1.1.1` before moving on — Let's Encrypt needs DNS resolving correctly.
- Open TCP ports 22 (SSH), 80 and 443 (HTTP/HTTPS) in your cloud firewall.

---

## 1. System packages

```bash
apt update && apt upgrade -y

# Web + PHP
apt install -y nginx php8.1-fpm php8.1-cli php8.1-mysql php8.1-mbstring \
               php8.1-xml php8.1-curl php8.1-gd php8.1-zip php8.1-bcmath \
               composer

# Databases
apt install -y mysql-server redis-server
# MongoDB 7.0 (optional — currently unused; install only if you re-enable Mongo features)
# wget -qO- https://www.mongodb.org/static/pgp/server-7.0.asc | tee /etc/apt/trusted.gpg.d/mongo.asc >/dev/null
# echo "deb [arch=amd64] https://repo.mongodb.org/apt/ubuntu jammy/mongodb-org/7.0 multiverse" \
#   > /etc/apt/sources.list.d/mongodb-org-7.0.list
# apt update && apt install -y mongodb-org

# Node 20 LTS
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs

# TLS + image tooling + secret scanner
apt install -y certbot python3-certbot-nginx imagemagick brotli unzip git curl uuid-runtime

VER=8.18.4
curl -fsSL "https://github.com/gitleaks/gitleaks/releases/download/v${VER}/gitleaks_${VER}_linux_x64.tar.gz" \
  | tar -xz -C /usr/local/bin gitleaks
chmod +x /usr/local/bin/gitleaks
gitleaks version
```

---

## 2. Clone the repo (deploy key)

Generate a per-server SSH key, add it to the repo as a Deploy Key (with **write access**), then clone:

```bash
ssh-keygen -t ed25519 -N "" -C "pk-betting@$(hostname)" -f /root/.ssh/pk-betting-deploy
cat /root/.ssh/pk-betting-deploy.pub
# Paste the public key at:
# https://github.com/Jewelpk528/Pk-Betting/settings/keys/new
# Title: pk-betting-server (<hostname>)
# Allow write access: YES

# SSH alias so this key is used only for this repo
cat >> /root/.ssh/config <<'EOF'
Host github-pk-betting
  HostName github.com
  User git
  IdentityFile /root/.ssh/pk-betting-deploy
  IdentitiesOnly yes
EOF
chmod 600 /root/.ssh/config

# Verify
ssh -T git@github-pk-betting
# > Hi Jewelpk528/Pk-Betting! You've successfully authenticated...

# Clone into the deploy area
mkdir -p /var/www/html/dev
cd /var/www/html/dev
git clone git@github-pk-betting:Jewelpk528/Pk-Betting.git pk-betting
```

The cloned monorepo has `node-backend/` and `php-backend/`. Symlink each into its production location so backups and routine work stay simple:

```bash
ln -s /var/www/html/dev/pk-betting/php-backend  /var/www/html/dev/admin.livo.ink
ln -s /var/www/html/dev/pk-betting/node-backend /var/www/html/dev/socket.livo.ink
```

(Alternative: copy instead of symlink if you prefer the deploy area separate from the live tree.)

---

## 3. MySQL — create DB and import schema

```bash
# Set a strong root password (or use auth_socket — adjust accordingly)
mysql -u root <<'EOF'
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'CHANGE_ME_STRONG';
CREATE DATABASE `livo-dev` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
FLUSH PRIVILEGES;
EOF

# Restore schema + seed data (path depends on where your dump lives)
zcat /path/to/livo-dev.sql.gz | mysql -u root -p livo-dev
```

If you don't have a dump yet, install the PHP backend first (Step 5) then bootstrap the admin user manually:

```sql
USE `livo-dev`;
INSERT INTO tbl_admin
  (first_name, last_name, email_id, mobile, role, addedby, status,
   password, sw_password, wallet)
VALUES
  ('admin@gmail.com','Admin','admin@gmail.com','9999999999',
   0, 0, 0,
   MD5('changeme'), MD5('changeme'), 0);
```

(Login is unsalted MD5 — change this password and harden the auth before going to production.)

---

## 4. Node backend (`socket.livo.ink`)

```bash
cd /var/www/html/dev/socket.livo.ink   # the symlink from Step 2
cp .env.example .env
# Fill in: DB_PASSWORD, JWTKEY, SMS_*, BASE_URL, CORS_ORIGIN, IMAGE_BASE_URL
# Keep PORT=3060

npm install --omit=dev
```

### Run under systemd (not PM2)

PM2's IPC channel (`NODE_CHANNEL_FD`) was observed to interfere with `server.listen()` on this codebase under some PM2 versions. **systemd is the supported supervisor.**

```bash
cat > /etc/systemd/system/socket-livo.service <<'EOF'
[Unit]
Description=socket.livo.ink (livo socket server)
After=network.target mysql.service redis.service

[Service]
Type=simple
User=root
WorkingDirectory=/var/www/html/dev/socket.livo.ink
ExecStart=/usr/bin/node /var/www/html/dev/socket.livo.ink/server.js
Restart=on-failure
RestartSec=5
StandardOutput=append:/var/log/socket-livo.log
StandardError=append:/var/log/socket-livo.err.log
Environment="NODE_ENV=production"

[Install]
WantedBy=multi-user.target
EOF

systemctl daemon-reload
systemctl enable --now socket-livo.service
systemctl status socket-livo --no-pager
ss -tlnp | grep ':3060'   # should show node listening
```

Logs:
```
tail -f /var/log/socket-livo.log
tail -f /var/log/socket-livo.err.log
journalctl -u socket-livo -f
```

---

## 5. PHP backend (`admin.livo.ink`)

```bash
cd /var/www/html/dev/admin.livo.ink   # symlink to php-backend
cp .env.example .env
# Fill in: DB_PASSWORD, FCM_SERVER_KEY, RAZORPAY_KEY_ID, API_SECRET,
#          XSOLLA_*, EASY_PE_*, PAYOUT_SECRET_KEY, INTERNAL_USER_TOKEN, ...

# Restore PHP dependencies
composer install --no-dev --optimize-autoloader

# Recreate writable directories that are gitignored
mkdir -p uploads data application/logs
chown -R www-data:www-data uploads data application/logs
chmod 755 uploads data application/logs

# CodeIgniter expects index.php as the entry point. Make sure www-data can read everything:
chown -R root:www-data .
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
chmod 660 .env
```

---

## 6. WebGL frontend (`games.livo.ink`)

```bash
mkdir -p /var/www/html/dev/games.livo.ink
cd /var/www/html/dev/games.livo.ink
```

Upload your Unity WebGL build:
- `index.html` (Unity template; edit `<title>` and `productName` to your brand)
- `Build/` — contains `*.data`, `*.framework.js`, `*.loader.js`, `*.wasm`
- `StreamingAssets/` — Addressables, audio, etc.
- `TemplateData/` — Unity boilerplate
- `logo.png` — shown on the loading screen
- `game.apk` — Android binary (served as the download)

Edit `index.html` if it ships with Brotli-encoded files (`.br`). Either:
- (Recommended) Rebuild with **Decompression Fallback ON** so the build is browser-agnostic, or
- Decompress on the server and serve raw:
  ```bash
  cd Build && for f in *.br; do brotli -d -k -o "${f}.tmp" "$f" && mv "${f}.tmp" "$f"; done
  ```
  and **omit** any `Content-Encoding: br` header from the nginx vhost (Safari iOS otherwise tries to brotli-decode an already-decoded payload and fails with `SyntaxError: Invalid character ''`).

Loading screen background should be dark (`body { background:#0a0a0a; }`) if your logo has a dark backdrop.

Set ownership and perms:
```bash
chown -R www-data:www-data /var/www/html/dev/games.livo.ink
find /var/www/html/dev/games.livo.ink -type d -exec chmod 755 {} \;
find /var/www/html/dev/games.livo.ink -type f -exec chmod 644 {} \;
```

---

## 7. Install landing (`livo.ink` + `www.livo.ink`)

The apex serves a tiny static page that auto-detects the device and links to the APK / iOS install profile.

```bash
mkdir -p /var/www/html/dev/livo.ink
cd /var/www/html/dev/livo.ink

# index.html (copy from admin.livo.ink/install.html or write your own)
cp /var/www/html/dev/admin.livo.ink/install.html index.html

# Generate iOS Web Clip profile
UUID1=$(uuidgen); UUID2=$(uuidgen)
# Pad your logo to a 192x192 square first:
convert /var/www/html/dev/games.livo.ink/logo.png \
  -resize 192x192 -background "#0a0a0a" -gravity center -extent 192x192 /tmp/icon.png
ICON_B64=$(base64 -w0 < /tmp/icon.png)

cat > install.mobileconfig <<EOF
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
  <key>PayloadContent</key>
  <array>
    <dict>
      <key>FullScreen</key><true/>
      <key>Icon</key><data>${ICON_B64}</data>
      <key>IsRemovable</key><true/>
      <key>Label</key><string>Livo</string>
      <key>PayloadIdentifier</key><string>app.livo.webclip</string>
      <key>PayloadType</key><string>com.apple.webClip.managed</string>
      <key>PayloadUUID</key><string>${UUID1}</string>
      <key>PayloadVersion</key><integer>1</integer>
      <key>Precomposed</key><true/>
      <key>URL</key><string>https://games.livo.ink/</string>
    </dict>
  </array>
  <key>PayloadDisplayName</key><string>Livo</string>
  <key>PayloadIdentifier</key><string>app.livo.configprofile</string>
  <key>PayloadType</key><string>Configuration</string>
  <key>PayloadUUID</key><string>${UUID2}</string>
  <key>PayloadVersion</key><integer>1</integer>
</dict>
</plist>
EOF

chown -R www-data:www-data /var/www/html/dev/livo.ink
```

---

## 8. Nginx vhosts

Four config files: `admin.livo.ink`, `socket.livo.ink`, `games.livo.ink`, `livo.ink`. The reference configs live under `deploy/nginx/` in this repo (or copy them from a running server).

Key points to know if you write them by hand:

**admin.livo.ink** (PHP + CORS for /uploads, /data, /assets):
- root: `/var/www/html/dev/admin.livo.ink`
- The first regex location MUST block PHP execution under `/uploads/`, `/data/`, `/assets/uploads/`, `/tmp/` so an image-upload bypass can't drop a webshell:
  ```nginx
  location ~* ^/(uploads|assets/uploads|tmp|data)/.*\.(php|phtml|phar|php3|php5|php7|pl|py|jsp|asp|sh|cgi)$ {
      deny all;
      return 403;
  }
  ```
- Plain prefix location for /uploads, /data, /assets to send `Access-Control-Allow-Origin: *` and handle OPTIONS preflight (the WebGL game fetches images from there).
- Exact-match location for `/install.mobileconfig` with `default_type application/x-apple-aspen-config` so iOS auto-installs the Web Clip.

**socket.livo.ink**:
- `proxy_pass http://127.0.0.1:3060;` (use the IPv4 literal, **not** `localhost` — `localhost` sometimes prefers `::1` and a Node listener on `*:3060` may not always be dual-stack on this kernel).
- WebSocket upgrade headers (`Upgrade $http_upgrade`, `Connection "upgrade"`).

**games.livo.ink**:
- Static file serving from `/var/www/html/dev/games.livo.ink`.
- `.apk` → `default_type application/vnd.android.package-archive` + `Content-Disposition: attachment`.
- `.wasm` → `default_type application/wasm`, `.data` → `application/octet-stream`, both with 1-year `immutable` cache.
- Do **not** set `Content-Encoding` headers unless the build files are actually compressed (Brotli/gzip). See step 6.

**livo.ink** (apex + www):
- Static `/var/www/html/dev/livo.ink`, `index.html`.
- Exact-match `/install.mobileconfig` same MIME as the admin one.

Enable + reload:

```bash
ln -sf /etc/nginx/sites-available/admin.livo.ink  /etc/nginx/sites-enabled/admin.livo.ink
ln -sf /etc/nginx/sites-available/socket.livo.ink /etc/nginx/sites-enabled/socket.livo.ink
ln -sf /etc/nginx/sites-available/games.livo.ink  /etc/nginx/sites-enabled/games.livo.ink
ln -sf /etc/nginx/sites-available/livo.ink        /etc/nginx/sites-enabled/livo.ink
nginx -t && systemctl reload nginx
```

After adding a new regex location, you may need a full `systemctl restart nginx` (not just reload) — reload sometimes doesn't pick up new locations until the worker recycles.

---

## 9. Let's Encrypt TLS

Once DNS is correct (step 0) and nginx is responding on port 80:

```bash
certbot --nginx --non-interactive --agree-tos \
  --register-unsafely-without-email --redirect \
  -d admin.livo.ink -d socket.livo.ink -d games.livo.ink \
  -d livo.ink -d www.livo.ink
```

Certbot will:
- issue one SAN certificate covering all 5 hostnames
- rewrite each nginx vhost to listen on 443 with the cert
- add HTTP→HTTPS redirects

Auto-renewal runs from a systemd timer that ships with the certbot package. Confirm with:
```bash
systemctl list-timers | grep certbot
```

---

## 10. Verify

```bash
# Each subdomain should be 200/404 (200 is normal; 404 on socket root is also normal — that's the socket.io default)
for h in admin.livo.ink socket.livo.ink games.livo.ink livo.ink www.livo.ink; do
  curl -sk -o /dev/null -w "$h -> %{http_code}\n" "https://$h/"
done

# Socket.io handshake
curl -sk -H "Origin: https://games.livo.ink" \
  "https://socket.livo.ink/socket.io/?EIO=4&transport=polling" | head -c 200
# Expected start: 0{"sid":"...","upgrades":["websocket"],"pingInterval":25000,...
```

Open the admin panel:
- https://admin.livo.ink/backend/auth/login

Open the WebGL game:
- https://games.livo.ink/

Open the install landing on a phone:
- iPhone Safari → https://livo.ink/ → tap **Download iOS App** → install profile → home screen icon
- Android Chrome → https://livo.ink/ → tap **Download Android App** → installs `game.apk`

---

## 11. Updates after the first deploy

```bash
cd /var/www/html/dev/pk-betting
git pull

# If node-backend changed:
cd node-backend && npm install --omit=dev
systemctl restart socket-livo

# If php-backend changed:
cd php-backend && composer install --no-dev --optimize-autoloader
# php-fpm picks up code changes immediately; reload OPcache if you've enabled it:
systemctl reload php8.1-fpm
```

For Unity WebGL / APK updates, drop the new files into `/var/www/html/dev/games.livo.ink/` — no service restart needed (it's served by nginx).

---

## 12. Operational defaults / hardening

- **MySQL** — root password set, bind to `127.0.0.1` only (default), no remote root login.
- **MongoDB** — disabled by default; only install if you re-enable Mongo features.
- **Firewall** — keep only 22/80/443 open. If using ufw:
  ```bash
  ufw default deny incoming
  ufw default allow outgoing
  ufw allow 22/tcp
  ufw allow 80/tcp
  ufw allow 443/tcp
  ufw enable
  ```
- **fail2ban** — recommended for SSH + nginx.
- **Admin auth** — `tbl_admin` uses unsalted MD5. Replace with bcrypt + change the default password before going live.
- **PHP-FPM upload cap** — adjust `client_max_body_size` in nginx and `upload_max_filesize` / `post_max_size` in `/etc/php/8.1/fpm/php.ini` to match the file sizes your admins upload.

---

## 13. Backups

The DB and `php-backend/uploads/` are the parts that can't be re-created from git.

```bash
# Daily mysqldump (add to root crontab)
0 3 * * * mysqldump --single-transaction --quick livo-dev | gzip > /root/backups/livo-dev-$(date +\%F).sql.gz

# Snap uploads weekly
0 4 * * 0 tar -czf /root/backups/uploads-$(date +\%F).tar.gz /var/www/html/dev/admin.livo.ink/uploads
```

Sync the backup directory to off-site storage (S3, B2, another VPS) — don't leave the only copy on the same disk.

---

## 14. Common troubleshooting

| Symptom | Likely cause | Fix |
|---|---|---|
| `socket.livo.ink` → 502 | Node not bound to 3060 | `systemctl status socket-livo`; `lsof -i :3060` should show `node *:3060 (LISTEN)`. If empty, check `/var/log/socket-livo.err.log`. |
| WebGL fails on Safari iOS with `SyntaxError: Invalid character ''` | Browser received Brotli-encoded bytes but couldn't decompress | Decompress `.br` files server-side and remove `Content-Encoding: br` from nginx (step 6). Or rebuild with Decompression Fallback ON. |
| CORS error on `/uploads/foo.jpg` from games.livo.ink | nginx vhost missing the `/uploads/` plain-prefix CORS block | Add the location from step 8. After editing, run `systemctl restart nginx` (full restart, not reload) so the new regex location takes effect. |
| Admin login fails with right password | password hash mismatch (bcrypt seed vs MD5 column) | Re-set in DB: `UPDATE tbl_admin SET sw_password=MD5('yourpass'), password=MD5('yourpass') WHERE id=1;` |
| `nginx -t` warns `conflicting server name`  | Two vhosts claim the same hostname | Find duplicates: `grep -r server_name /etc/nginx/sites-enabled/` and remove the older one. |
| Teen patti game says "Only one user on table" | Bot didn't auto-join | Check `tbl_users` has at least one row with `user_type=1, status=0, isDeleted=0, table_id=0, wallet >= boot_value*50`. Also make sure `tbl_setting.robot_teenpatti=0`. |

---

## 15. Pre-commit secret scanner

The repo ships with a gitleaks config (`.gitleaks.toml`). To enable the hook on a developer or server checkout:

```bash
# from inside the cloned repo
cp .git/hooks/pre-commit.sample .git/hooks/pre-commit  # remove this line if you don't have a sample
cat > .git/hooks/pre-commit <<'EOF'
#!/bin/bash
if command -v gitleaks >/dev/null 2>&1; then
  gitleaks protect --staged --no-banner --redact --config .gitleaks.toml --verbose || {
    echo "[pre-commit] gitleaks blocked a secret. Move it to .env and use getenv()/process.env."
    exit 1
  }
fi
EOF
chmod +x .git/hooks/pre-commit
```

A GitHub Actions workflow at `.github/workflows/secret-scan.yml` runs the same scan on every push/PR (add it via GitHub UI if it isn't already in the repo — pushing it requires a PAT with the `workflow` scope).
