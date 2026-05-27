server {
    server_name livo.ink www.livo.ink;
    root /var/www/html/dev/livo.ink;
    index index.html;

    location ~ /\.(?!well-known).* { deny all; }

    location = /install.mobileconfig {
        default_type application/x-apple-aspen-config;
        add_header Content-Disposition "inline" always;
        add_header Cache-Control "no-store" always;
        try_files $uri =404;
    }

    location / { try_files $uri $uri/ =404; }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/admin.livo.ink/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/admin.livo.ink/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot


}
server {
    if ($host = www.livo.ink) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    if ($host = livo.ink) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    listen 80;
    server_name livo.ink www.livo.ink;
    return 404; # managed by Certbot




}