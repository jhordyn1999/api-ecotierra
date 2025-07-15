#!/bin/bash

# Reemplaza configuración de NGINX personalizada
cp /home/site/wwwroot/default /etc/nginx/sites-available/default

# Inicia PHP-FPM
service php8.2-fpm start

# Reinicia NGINX
service nginx restart

# Deja el contenedor corriendo (para que no muera)
tail -f /dev/null
