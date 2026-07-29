const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

const fullCommand = `
echo "=== Removing broken storage link ==="
sudo rm -rf /var/www/temuruang/public/storage
echo "=== Creating fresh storage symlink ==="
cd /var/www/temuruang && sudo php artisan storage:link
echo "=== Verifying symlink ==="
ls -la /var/www/temuruang/public/storage
echo "=== Testing thumbnail access ==="
ls -la /var/www/temuruang/public/storage/templates/thumbnails/ 2>&1 | head -10
echo "=== Fix permissions ==="
sudo chown -R www-data:www-data /var/www/temuruang/public/storage
echo "=== Testing via curl ==="
curl -sI https://temuruang.com/storage/templates/thumbnails/wedding-01.jpg 2>&1 | head -3
echo "=== DONE ==="
`;

console.log('🔧 Fixing storage symlink on VPS...\n');

const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Connected!\n');
    
    conn.exec(fullCommand, (err, stream) => {
        if (err) throw err;
        
        stream.on('close', (code) => {
            console.log('\n✅ Done. Exit code:', code);
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
