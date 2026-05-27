server {
    server_name admin.livo.ink;

    root /var/www/html/dev/admin.livo.ink;
    index index.php index.html index.htm;

    location ~ /\.(?!well-known).* { deny all; }

    # block dangerous scripts under upload dirs
    location ~* ^/(uploads|assets/uploads|tmp|data)/.*\.(php|phtml|phar|php3|php5|php7|pl|py|jsp|asp|sh|cgi)$ {
        deny all;
        return 403;
    }

    # CORS + OPTIONS for /uploads, /data, /assets
    location ~ ^/(uploads|data|assets)/ {
        add_header Access-Control-Allow-Origin "*" always;
        add_header Access-Control-Expose-Headers "Content-Length,Content-Type" always;
        add_header Cross-Origin-Resource-Policy "cross-origin" always;
        add_header Cache-Control "public, max-age=2592000" always;
        if ($request_method = OPTIONS) {
            add_header Access-Control-Allow-Origin "*" always;
            add_header Access-Control-Allow-Methods "GET, HEAD, OPTIONS" always;
            add_header Access-Control-Allow-Headers "Origin, Content-Type, Accept, Authorization" always;
            add_header Access-Control-Max-Age 86400 always;
            return 204;
        }
        try_files $uri =404;
    }

    # iOS install profile
    location = /install.mobileconfig {
        default_type application/x-apple-aspen-config;
        add_header Content-Disposition "inline" always;
        add_header Cache-Control "no-store" always;
        try_files $uri =404;
    }

    location / { try_files $uri $uri/ /index.php?$query_string; }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
    }

    location ~* \.(js|css|pdf|html|swf)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/admin.livo.ink/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/admin.livo.ink/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

}
server {
    if ($host = admin.livo.ink) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    listen 80;
    server_name admin.livo.ink;
    return 404; # managed by Certbot


}