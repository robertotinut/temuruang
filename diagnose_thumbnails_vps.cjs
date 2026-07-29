const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

const fullCommand = `
ls -la /var/www/temuruang/public/storage
echo "---THUMBNAILS DIR---"
ls -la /var/www/temuruang/storage/app/public/templates/thumbnails/ 2>&1
echo "---FILE SIZES---"
du -sh /var/www/temuruang/storage/app/public/templates/thumbnails/* 2>&1
echo "---DB CHECK---"
cd /var/www/temuruang && php -r "
require 'vendor/autoload.php';
\\$app = require_once 'bootstrap/app.php';
\\$kernel = \\$app->make(Illuminate\\\\Contracts\\\\Console\\\\Kernel::class);
\\$kernel->bootstrap();
foreach(App\\\\Models\\\\Template::all() as \\$t) {
    echo \\$t->slug . ': ' . (\\$t->thumbnail ?: 'NULL') . PHP_EOL;
}
"
echo "---CURL TEST---"
curl -sI https://temuruang.com/storage/templates/thumbnails/wedding-01.jpg 2>&1 | head -5
`;

console.log('🔍 Diagnosing thumbnails on VPS...\n');

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
