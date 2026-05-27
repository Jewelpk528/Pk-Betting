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

## Setup

### node-backend
```
cd node-backend
cp .env.example .env   # fill in DB password etc.
npm install
node server.js          # or use systemd / pm2
```

### php-backend
```
cd php-backend
cp .env.example .env
composer install        # restores vendor/ which is gitignored
# point nginx + php-fpm at this directory
```

## Live URLs

- Landing/install: https://livo.ink/
- Admin: https://admin.livo.ink/backend/auth/login
- Socket: https://socket.livo.ink/socket.io/
- WebGL game: https://games.livo.ink/
