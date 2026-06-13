const { Client } = require('ssh2');

const conn = new Client();
const ip = '43.133.154.13';
const username = 'ubuntu';
const password = 'shadow-64$-storm';

conn.on('ready', () => {
    console.log('Memperbaiki .env di VPS...');
    const commands = `
        cd /var/www/temuruang
        sudo sed -i 's|APP_URL=.*|APP_URL=http://43.133.154.13|' .env
        sudo sed -i 's|APP_ENV=.*|APP_ENV=production|' .env
        sudo sed -i 's|APP_DEBUG=.*|APP_DEBUG=false|' .env
        sudo sed -i 's|GOOGLE_REDIRECT_URI=.*|GOOGLE_REDIRECT_URI=http://43.133.154.13/auth/google/callback|' .env
        sudo sed -i 's|DB_DATABASE=.*|DB_DATABASE=db_temuruang|' .env
        sudo sed -i 's|DB_USERNAME=.*|DB_USERNAME=admin|' .env
        sudo sed -i 's|DB_PASSWORD=.*|DB_PASSWORD=password123|' .env
        sudo php artisan config:clear
        sudo php artisan cache:clear
        sudo php artisan route:clear
        sudo php artisan view:clear
        sudo systemctl restart nginx
        sudo systemctl restart php8.2-fpm
    `;
    
    conn.exec(commands, (err, stream) => {
        if (err) throw err;
        stream.on('close', (code, signal) => {
            console.log('Perbaikan selesai dengan kode: ' + code);
            conn.end();
        }).on('data', (data) => {
            process.stdout.write('' + data);
        }).stderr.on('data', (data) => {
            process.stderr.write('' + data);
        });
    });
}).on('error', (err) => {
    console.error('Koneksi Gagal:', err);
}).connect({
    host: ip,
    port: 22,
    username: username,
    password: password,
    readyTimeout: 99999
});
