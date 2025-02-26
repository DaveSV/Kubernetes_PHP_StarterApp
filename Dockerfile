# Usar la imagen oficial de PHP con Apache
FROM php:8.3-apache

# Copiar el código PHP y la imagen
COPY . /var/www/html/


# Copiar el script de inicio
COPY startup.sh /usr/local/bin/startup.sh

# Darle permisos dentro del contenedor
RUN chmod +x /usr/local/bin/startup.sh

# Usar el script como punto de entrada
ENTRYPOINT ["/usr/local/bin/startup.sh"]
