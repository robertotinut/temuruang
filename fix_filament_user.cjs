const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Memperbaiki model User...");
    
    // We will use sed to insert the necessary interface and method
    const cmds = `
        cd /var/www/hokee
        
        # Tambahkan namespace FilamentUser
        sudo sed -i '/use Illuminate\\\\Foundation\\\\Auth\\\\User as Authenticatable;/a use Filament\\\\Models\\\\Contracts\\\\FilamentUser;\\nuse Filament\\\\Panel;' app/Models/User.php
        
        # Tambahkan implements FilamentUser
        sudo sed -i 's/class User extends Authenticatable/class User extends Authenticatable implements FilamentUser/' app/Models/User.php
        
        # Tambahkan method canAccessPanel di akhir class sebelum }
        # Karena kita tahu class berakhir dengan }, kita insert sebelum baris terakhir
        sudo sed -i '/^}$/i \\    public function canAccessPanel(Panel $panel): bool\\n    {\\n        return true;\\n    }\\n' app/Models/User.php
        
        echo "✅ Model User berhasil diperbarui untuk memberi akses Filament!"
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
