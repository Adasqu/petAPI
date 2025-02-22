PHP FROM php:8.0-fpm 
WORKDIR /var/www 
RUN apt-get update && apt-get install -y \ build-essential \ libpng-dev \ libjpeg-dev \ libfreetype6-dev \ locales \ zip \ jpegoptim optipng pngquant gifsicle \ vim \ unzip \ git \ curl 
PHP RUN docker-php-ext-configure gd --with-freetype --with-jpeg RUN docker-php-ext-install pdo pdo_mysql gd 
Composer COPY --from=composer:latest /usr/bin/composer /usr/bin/composer 
COPY . /var/www # Instalacja zależności aplikacji RUN composer install
RUN chown -R www-data:www-data /var/www RUN chmod -R 755 /var/www # Ustawienia roboczego katalogu WORKDIR /var/www # Expose port 9000 and start php-fpm server EXPOSE 9000 CMD ["php-fpm"]