#!/bin/bash

# Copiar el contenido de /home/site/wwwroot/public a /home/site/wwwroot si no existe
cp -a /home/site/wwwroot/public/* /home/site/wwwroot

# Iniciar PHP-FPM
php-fpm
