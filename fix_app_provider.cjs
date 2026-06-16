const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Memperbaiki AppServiceProvider.php...");
    
    const correctCode = `<?php

namespace App\\Providers;

use Illuminate\\Support\\ServiceProvider;
use Illuminate\\Support\\Facades\\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') !== 'local') { 
            URL::forceScheme('https'); 
        }
    }
}
`;

    // Kita akan gunakan base64 untuk menghindari masalah quoting
    const base64Code = Buffer.from(correctCode).toString('base64');

    const cmds = `
        cd /var/www/hokee
        echo "${base64Code}" | base64 -d | sudo tee app/Providers/AppServiceProvider.php > /dev/null
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
