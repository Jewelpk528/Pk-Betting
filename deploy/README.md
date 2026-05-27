# Production deploy reference

These are the live nginx vhosts and systemd unit running on the production
server. Treat them as a starting point — copy into `/etc/nginx/sites-available/`
and `/etc/systemd/system/`, then `nginx -t && systemctl reload nginx` or
`systemctl daemon-reload && systemctl enable --now socket-livo`.

See `../DEPLOYMENT.md` for the full bootstrap walkthrough.
