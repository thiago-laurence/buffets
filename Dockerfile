FROM php:7.3-apache

# Habilitar extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar archivo de configuración de PHP
COPY ./php.ini /usr/local/etc/php/

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar código fuente del proyecto
COPY ./src/ ./

# Exponer el puerto 80 para Apache
EXPOSE 80

# Comando por defecto para iniciar Apache
CMD ["apache2-foreground"]
