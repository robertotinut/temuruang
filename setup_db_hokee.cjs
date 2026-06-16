const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Menyiapkan Database Hokee...");
    const cmds = `
        cd /var/www/hokee
        
        # 1. Buat Database MySQL
        # Kita buat db_hokee dan beri akses ke user admin
        sudo mysql -u root -e "CREATE DATABASE IF NOT EXISTS db_hokee CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
        sudo mysql -u root -e "GRANT ALL PRIVILEGES ON db_hokee.* TO 'admin'@'localhost';"
        sudo mysql -u root -e "FLUSH PRIVILEGES;"
        
        # 2. Update .env hokee
        sudo sed -i 's/DB_DATABASE=laravel/DB_DATABASE=db_hokee/' .env
        sudo sed -i 's/DB_USERNAME=root/DB_USERNAME=admin/' .env
        sudo sed -i 's/DB_PASSWORD=/DB_PASSWORD=password123/' .env
        
        # Clear config cache
        sudo php artisan config:clear
        
        # 3. Jalankan Migrasi & Seeder
        sudo php artisan migrate --force
        sudo php artisan db:seed --force || true
        
        echo "✅ Database db_hokee berhasil dibuat dan dimigrasi!"
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
