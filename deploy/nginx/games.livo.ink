server {
    server_name games.livo.ink;
    root /var/www/html/dev/games.livo.ink;
    index index.html;

    location ~ /\.(?!well-known).* { deny all; }

    location ~* \.apk$ {
        default_type application/vnd.android.package-archive;
        add_header Content-Disposition "attachment";
        add_header Cache-Control "public, max-age=300";
    }
    location ~ \.wasm\.br$ { default_type application/wasm;            add_header Cache-Control "public, max-age=31536000, immutable"; }
    location ~ \.data\.br$ { default_type application/octet-stream;    add_header Cache-Control "public, max-age=31536000, immutable"; }
    location ~ \.framework\.js\.br$ { default_type application/javascript; add_header Cache-Control "public, max-age=31536000, immutable"; }
    location ~ \.loader\.js$ { default_type application/javascript;    add_header Cache-Control "public, max-age=31536000, immutable"; }
    location ~ \.wasm$ { default_type application/wasm;                add_header Cache-Control "public, max-age=31536000, immutable"; }
    location ~ \.data$ { default_type application/octet-stream;        add_header Cache-Control "public, max-age=31536000, immutable"; }

    location / { try_files $uri $uri/ =404; }
    client_max_body_size 200m;

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/admin.livo.ink/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/admin.livo.ink/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

}
server {
    if ($host = games.livo.ink) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    listen 80;
    server_name games.livo.ink;
    return 404; # managed by Certbot


}