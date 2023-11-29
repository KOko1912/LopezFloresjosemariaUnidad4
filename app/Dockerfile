# syntax=docker/dockerfile:1

FROM php:8.2.0-apache

# Instala extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de la aplicación PHP al contenedor
COPY app/ /var/www/html/

# Copia el script init.sql al contenedor
COPY db/init.sql /docker-entrypoint-initdb.d/

# Configura el acceso a la base de datos en la aplicación PHP (si es necesario)

# Expone el puerto 80
EXPOSE 80

# Comando para iniciar el servidor Apache
CMD ["apache2-foreground"]
