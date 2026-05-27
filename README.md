# Pk-Betting

Backend for **livo.ink** — a real-money gaming platform (teen patti, rummy, aviator, dragon tiger, colour prediction, baccarat, roulette, jackpot, etc.).

## Layout

```
node-backend/   Node.js socket.io + REST API (port 3060)
                Sequelize + MySQL. Hosts all game socket namespaces.
                Runs in production via systemd: socket-livo.service

php-backend/    CodeIgniter PHP admin panel + game API
                Served by nginx + php-fpm at https://admin.livo.ink
```

## Live URLs

| | URL |
|---|---|
| Install landing | https://livo.ink/ • https://www.livo.ink/ |
| Admin panel    | https://admin.livo.ink/backend/auth/login |
| Socket server  | https://socket.livo.ink/socket.io/ |
| WebGL game     | https://games.livo.ink/ |
| Android APK    | https://games.livo.ink/game.apk |
| iOS Web Clip   | tap "Download iOS App" on https://livo.ink/ |

## Quick local setup

### node-backend (port 3060)

```bash
cd node-backend
cp .env.example .env       # set DB password, BASE_URL, CORS_ORIGIN, etc.
npm install
node server.js
```

### php-backend

```bash
cd php-backend
cp .env.example .env       # set DB password, FCM key, Razorpay, etc.
composer install
# Serve via nginx + php-fpm. The webroot is the php-backend/ directory itself
# (CodeIgniter uses index.php as the front controller).
```

The MySQL schema lives in `livo-dev`. To get a fresh dev DB, import a recent dump:

```bash
zcat livo-dev.sql.gz | mysql -u root -p livo-dev
```

If no dump is available, the admin app will create the schema on first run, but you'll need to seed `tbl_admin` manually (see DEPLOYMENT.md §3).

## Production deployment

See [**DEPLOYMENT.md**](./DEPLOYMENT.md) for step-by-step VPS bootstrap (Ubuntu 22.04 → fully running stack with TLS, systemd, nginx vhosts, CORS, iOS Web Clip, etc.).

Quick summary of the production setup:

- **Ubuntu 22.04** with nginx + php8.1-fpm + mysql + redis + node 20 LTS
- **socket.livo.ink** runs under **systemd** (not PM2 — PM2's IPC channel was observed to break `server.listen()` for this codebase)
- **5-name SAN cert** from Let's Encrypt covers the apex + 4 subdomains
- WebGL `.br` files are **decompressed at deploy time** and served without `Content-Encoding` so Safari iOS works
- nginx blocks PHP execution under `/uploads`, `/data`, `/assets/uploads`, `/tmp` to prevent image-upload webshell drops
- The cloned repo lives at `/var/www/html/dev/pk-betting/`; the production tree symlinks `php-backend` → `admin.livo.ink/` and `node-backend` → `socket.livo.ink/`

## Secret management

`.env` is **never committed**. The repo ships with `.env.example` files listing every variable the apps read via `getenv()` / `process.env`. A **gitleaks pre-commit hook** (config in `.gitleaks.toml`) blocks new secret patterns from being committed; a GitHub Actions workflow runs the same scan on every push/PR.

If you find a secret made it into git history anyway, the standard playbook is:
1. Rotate the secret at the source (Firebase / Razorpay / Xsolla / your payment gateway).
2. Replace the value in code with `getenv("VAR_NAME") ?: ""` (PHP) or `process.env.VAR_NAME || ""` (Node).
3. Force-push to overwrite the bad commit; treat the leaked value as compromised even after force-push, because GitHub caches commit blobs.

## Contributing

- All new config values must be loaded from env vars, never hard-coded.
- Run `gitleaks detect --no-banner --no-git --config .gitleaks.toml` locally before pushing if you've touched anything that handles credentials.
- The pre-commit hook (`.git/hooks/pre-commit` — see DEPLOYMENT.md §15) catches most mistakes for you.
