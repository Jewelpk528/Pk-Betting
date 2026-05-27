server {
    server_name socket.livo.ink;
    location ~ /\.(?!well-known).* { deny all; }
    location / {
        proxy_pass http://127.0.0.1:3060;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_cache_bypass $http_upgrade;
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/admin.livo.ink/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/admin.livo.ink/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

}
server {
    if ($host = socket.livo.ink) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    listen 80;
    server_name socket.livo.ink;
    return 404; # managed by Certbot


}