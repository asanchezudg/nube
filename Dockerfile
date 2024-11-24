FROM php:8.0-apache

# Copiar los archivos de la aplicación
COPY . /var/www/html/

# Configurar los permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto 80
EXPOSE 80