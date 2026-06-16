const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

const setupCommands = `
#!/bin/bash
set -e

echo "1. Cloning repository..."
cd /var/www
if [ -d "hokee" ]; then
    echo "Folder hokee sudah ada. Melakukan pull..."
    cd hokee
    sudo git pull origin main
else
    sudo git clone https://github.com/robertotinut/hokee.git hokee
    cd hokee
fi

echo "2. Instalasi Composer & Environment..."
sudo composer install --no-dev --optimize-autoloader
if [ ! -f ".env" ]; then
    sudo cp .env.example .env
    sudo php artisan key:generate
fi

echo "3. Optimasi Laravel..."
sudo php artisan storage:link || true
sudo php artisan optimize:clear

echo "4. Mengatur Permission..."
sudo chown -R www-data:www-data /var/www/hokee
sudo chmod -R 775 /var/www/hokee/storage /var/www/hokee/bootstrap/cache

echo "5. Setup Nginx untuk hokee.web.id..."
cat << 'EOF' | sudo tee /etc/nginx/sites-available/hokee
server {
    listen 80;
    server_name hokee.web.id www.hokee.web.id;
    root /var/www/hokee/public;

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
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

sudo ln -sf /etc/nginx/sites-available/hokee /etc/nginx/sites-enabled/
sudo systemctl restart nginx

echo "✅ Setup Selesai! Website hokee.web.id sudah live!"
`;

console.log('🚀 Menghubungkan ke VPS...');
const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Terhubung! Menjalankan setup Hokee...');
    
    conn.exec(setupCommands, (err, stream) => {
        if (err) throw err;
        
        stream.on('close', (code, signal) => {
            console.log('✅ Proses eksekusi script selesai!');
            conn.end();
        }).on('data', (data) => {
            process.stdout.write(data.toString());
        }).stderr.on('data', (data) => {
            process.stderr.write(data.toString());
        });
    });
}).connect(sshConfig);

conn.on('error', (err) => {
    console.error('❌ SSH Error:', err);
});
