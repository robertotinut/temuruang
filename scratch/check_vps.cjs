const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm',
    readyTimeout: 20000
};

const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Connected to VPS!');
    
    // Check if the modified code exists on the VPS
    conn.exec('grep -n "animateWithGsap" /var/www/temuruang/resources/views/templates/wedding/wedding-32.blade.php', (err, stream) => {
        if (err) throw err;
        console.log('--- Grep animateWithGsap Output ---');
        stream.on('data', (data) => {
            process.stdout.write(data.toString());
        }).stderr.on('data', (data) => {
            process.stderr.write(data.toString());
        });
        
        stream.on('close', () => {
            console.log('-----------------------------------');
            
            // Clear view cache, config cache, and restart php-fpm to clear opcache
            console.log('⚡ Clearing Laravel cache and reloading PHP-FPM...');
            conn.exec('cd /var/www/temuruang && sudo php artisan view:clear && sudo php artisan config:clear && sudo php artisan cache:clear && (sudo systemctl restart php8.2-fpm || sudo systemctl restart php8.1-fpm || sudo systemctl restart php8.3-fpm || echo "PHP-FPM restart bypassed") && sudo systemctl reload nginx', (err, fpmStream) => {
                if (err) throw err;
                fpmStream.on('data', (data) => {
                    process.stdout.write(data.toString());
                }).stderr.on('data', (data) => {
                    process.stderr.write(data.toString());
                });
                fpmStream.on('close', () => {
                    console.log('✅ VPS Cache cleared and Services reloaded!');
                    conn.end();
                });
            });
        });
    });
}).on('error', (err) => {
    console.error('Connection Error:', err);
}).connect(sshConfig);
