#!/bin/bash

# ==========================================
# Script Setup Otomatis VPS Ubuntu Laravel
# ==========================================

echo "Memulai proses instalasi..."

# 1. Update system & install dependencies dasar
sudo apt update -y
sudo apt install -y software-properties-common curl unzip git

# 2. Install Nginx
sudo apt install -y nginx

# 3. Install PHP 8.2 & Ekstensi (Laravel 11 butuh PHP 8.2+)
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update -y
sudo apt install -y php8.2-fpm php8.2-cli php8.2-mysql php8.2-curl php8.2-xml php8.2-mbstring php8.2-zip php8.2-bcmath php8.2-intl

# 4. Install MySQL Server
sudo apt install -y mysql-server

# 5. Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 6. Menyiapkan Database
echo "Membuat database dan user..."
sudo mysql -e "CREATE DATABASE IF NOT EXISTS db_temuruang;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'password123';"
sudo mysql -e "GRANT ALL PRIVILEGES ON db_temuruang.* TO 'admin'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# Impor database jika file temuruang.sql tersedia
if [ -f "temuruang.sql" ]; then
    echo "Mengimpor database dari temuruang.sql..."
    sudo mysql db_temuruang < temuruang.sql
fi

# 7. Memindahkan dan Ekstrak Project
echo "Menyiapkan direktori web..."
sudo mkdir -p /var/www/temuruang
sudo cp temuruang.zip /var/www/temuruang/
cd /var/www/temuruang
sudo unzip -o temuruang.zip

# Jika unzip membuat folder di dalam folder (misal: temuruang/temuruang), pindahkan isinya:
if [ -d "temuruang" ]; then
    sudo mv temuruang/* .
    sudo mv temuruang/.* . 2>/dev/null
    sudo rmdir temuruang
fi

# 8. Setup Laravel (.env dan Composer)
if [ ! -f ".env" ]; then
    sudo cp .env.example .env
fi

# Konfigurasi .env
sudo sed -i 's/DB_DATABASE=.*/DB_DATABASE=db_temuruang/' .env
sudo sed -i 's/DB_USERNAME=.*/DB_USERNAME=admin/' .env
sudo sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=password123/' .env
sudo sed -i 's/APP_URL=.*/APP_URL=http:\/\/43.133.154.13/' .env
sudo sed -i 's/APP_ENV=.*/APP_ENV=production/' .env
sudo sed -i 's/APP_DEBUG=.*/APP_DEBUG=false/' .env

# Jalankan instalasi composer (lewati package dev)
sudo composer install --optimize-autoloader --no-dev
sudo php artisan key:generate
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache

# 9. Atur Permissions (Sangat Penting)
echo "Mengatur permission..."
sudo chown -R www-data:www-data /var/www/temuruang
sudo find /var/www/temuruang -type f -exec chmod 644 {} \;
sudo find /var/www/temuruang -type d -exec chmod 755 {} \;
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

# 10. Konfigurasi Nginx
echo "Mengonfigurasi Nginx..."
cat << 'EOF' | sudo tee /etc/nginx/sites-available/temuruang
server {
    listen 80;
    server_name 43.133.154.13;
    root /var/www/temuruang/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

sudo ln -s /etc/nginx/sites-available/temuruang /etc/nginx/sites-enabled/
# Hapus default nginx
sudo rm -f /etc/nginx/sites-enabled/default

# Restart Nginx
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm

echo "================================================="
echo "Setup Selesai! Website seharusnya sudah bisa diakses di http://43.133.154.13"
echo "================================================="
