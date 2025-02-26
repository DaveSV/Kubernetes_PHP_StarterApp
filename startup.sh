#!/bin/bash

# Si PORT no está definido, usa 8080 por defecto
PORT=${PORT:-8080}

# Reemplaza el puerto en los archivos de configuración de Apache
sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Asegurarse de que Apache esté corriendo
exec apache2-foreground
