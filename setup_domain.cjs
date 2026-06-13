const { Client } = require('ssh2');

const conn = new Client();
const ip = '43.133.154.13';
const username = 'ubuntu';
const password = 'shadow-64$-storm';
const domain = 'temuruang.com';

conn.on('ready', () => {
    console.log('Menyiapkan Domain dan HTTPS di VPS...');
    const commands = `
        cd /var/www/temuruang
        
        # Update .env
        sudo sed -i 's|APP_URL=.*|APP_URL=https://${domain}|' .env
        sudo sed -i 's|GOOGLE_REDIRECT_URI=.*|GOOGLE_REDIRECT_URI=https://${domain}/auth/google/callback|' .env
        
        # Clear Cache
        sudo php artisan config:clear
        sudo php artisan cache:clear
        sudo php artisan route:clear
        sudo php artisan view:clear
        
        # Update Nginx config
        sudo sed -i 's|server_name 43.133.154.13;|server_name ${domain} www.${domain};|' /etc/nginx/sites-available/temuruang
        sudo systemctl restart nginx
        
        # Install Certbot untuk SSL (HTTPS)
        sudo apt update -y
        sudo apt install -y certbot python3-certbot-nginx
        
        # Kita tidak langsung jalankan certbot otomatis karena propagasi DNS mungkin belum selesai.
        # Nanti kita bisa jalankan manual jika domain sudah bisa diakses.
        
        echo "Setup Selesai!"
    `;
    
    conn.exec(commands, (err, stream) => {
        if (err) throw err;
        stream.on('close', (code, signal) => {
            console.log('Eksekusi selesai dengan kode: ' + code);
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
