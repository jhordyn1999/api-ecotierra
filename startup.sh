#!/bin/bash

# Copia tu configuración personalizada de nginx
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Inicia PHP-FPM en segundo plano
service php8.2-fpm start

# Ejecuta NGINX en primer plano para mantener vivo el contenedor
nginx -g "daemon off;"
