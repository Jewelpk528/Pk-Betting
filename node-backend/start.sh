#!/bin/bash
# PM2 leaks NODE_CHANNEL_FD into our env via child_process.fork(), which makes
# Node intercept listen() for cluster coordination. We dont want that — unset.
unset NODE_CHANNEL_FD
unset NODE_CHANNEL_SERIALIZATION_MODE
unset NODE_APP_INSTANCE
exec node server.js
