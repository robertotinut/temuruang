const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Memperbaiki konfigurasi URL dan HTTPS...");
    const cmds = `
        cd /var/www/hokee
        
        # 1. Update .env APP_URL
        sudo sed -i "s|APP_URL=http://localhost|APP_URL=https://hokee.web.id|g" .env
        sudo sed -i "s|APP_ENV=local|APP_ENV=production|g" .env
        sudo sed -i "s|APP_DEBUG=true|APP_DEBUG=false|g" .env
        
        # 2. Force HTTPS di AppServiceProvider.php
        sudo sed -i "/public function boot()/a \\\n        if (env('APP_ENV') !== 'local') { \\\\URL::forceScheme('https'); }" app/Providers/AppServiceProvider.php
        
        # Pastikan Facade URL di-import
        sudo sed -i "/namespace App\\\\Providers;/a use Illuminate\\\\Support\\\\Facades\\\\URL;" app/Providers/AppServiceProvider.php
        
        # 3. Hapus cache config
        sudo php artisan optimize:clear
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            console.log('✅ Perbaikan selesai!');
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
