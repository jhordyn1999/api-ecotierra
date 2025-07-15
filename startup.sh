#!/bin/bash

# Copia el archivo de configuración de nginx personalizado
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Inicia PHP y Nginx
service php8.2-fpm start
nginx -g "daemon off;"
