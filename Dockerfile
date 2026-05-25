# PHP 8.2 ve Apache içeren resmi imajı kullanıyoruz
FROM php:8.2-apache

# Gerekli sistem eklentilerini ve PostgreSQL sürücülerini kuruyoruz
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql

# Apache Mod_Rewrite aktif ediyoruz (Laravel URL yapısı için şart)
RUN a2enmod rewrite

# Apache varsayılan dizinini Laravel'in "public" klasörüne yönlendiriyoruz
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Composer'ı yüklüyoruz
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizinini belirliyoruz
WORKDIR /var/www/html

# Proje dosyalarımızı kopyalıyoruz
COPY . .

# Laravel paketlerini kuruyoruz
RUN composer install --optimize-autoloader --no-dev

# Storage ve Cache klasörlerine yazma izni veriyoruz
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Konteynerın 80 portundan dışarı açılacağını belirtiyoruz
EXPOSE 80