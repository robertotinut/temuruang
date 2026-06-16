const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Memperbaiki .env dan menjalankan migrasi...");
    const cmds = `
        cd /var/www/hokee
        
        # Hapus baris DB_ lama
        sudo sed -i '/DB_CONNECTION/d' .env
        sudo sed -i '/DB_HOST/d' .env
        sudo sed -i '/DB_PORT/d' .env
        sudo sed -i '/DB_DATABASE/d' .env
        sudo sed -i '/DB_USERNAME/d' .env
        sudo sed -i '/DB_PASSWORD/d' .env
        
        # Tambahkan konfigurasi MySQL yang benar
        echo "DB_CONNECTION=mysql" | sudo tee -a .env
        echo "DB_HOST=127.0.0.1" | sudo tee -a .env
        echo "DB_PORT=3306" | sudo tee -a .env
        echo "DB_DATABASE=db_hokee" | sudo tee -a .env
        echo "DB_USERNAME=admin" | sudo tee -a .env
        echo "DB_PASSWORD=password123" | sudo tee -a .env
        
        sudo php artisan config:clear
        
        echo "Menjalankan migrasi database..."
        sudo php artisan migrate --force
        
        # Jangan jalankan seeder karena sepertinya ada error bawaan dari factory fake()
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            console.log('✅ Selesai!');
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
