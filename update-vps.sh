#!/bin/bash

# ==========================================
# Script Update VPS Ubuntu Laravel
# ==========================================

echo "Memulai proses update..."

echo "Memindahkan dan Ekstrak Project..."
sudo cp temuruang.zip /var/www/temuruang/
cd /var/www/temuruang

# Extract over existing files (excluding node_modules/vendor which are usually ignored in zip)
sudo unzip -o temuruang.zip

# Jalankan instalasi composer (jika ada update package)
sudo composer install --optimize-autoloader --no-dev

# Jalankan migrasi database (untuk fitur-fitur baru seperti Order dan Subscription duration)
sudo php artisan migrate --force

# Bersihkan cache
sudo php artisan cache:clear
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache

# Atur Permissions
echo "Mengatur permission..."
sudo chown -R www-data:www-data /var/www/temuruang
sudo find /var/www/temuruang -type f -exec chmod 644 {} \;
sudo find /var/www/temuruang -type d -exec chmod 755 {} \;
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

# Restart Nginx and PHP-FPM
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm

echo "================================================="
echo "Update Selesai! Website sudah diperbarui dengan fitur terbaru."
echo "================================================="
