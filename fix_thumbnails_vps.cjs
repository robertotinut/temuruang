const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

// Fix permissions first, then run thumbnail scripts as www-data
const fullCommand = [
    'sudo chmod -R 777 /var/www/temuruang/storage/app/public/templates',
    'cd /var/www/temuruang && sudo -u www-data php scratch/set_thumbnails.php 2>&1',
    'cd /var/www/temuruang && sudo -u www-data php scratch/set_more_thumbnails.php 2>&1',
    'cd /var/www/temuruang && sudo -u www-data php scratch/set_fallback_thumbnails.php 2>&1',
    'cd /var/www/temuruang && sudo -u www-data php scratch/fix_three_thumbnails.php 2>&1',
    'sudo chmod -R 775 /var/www/temuruang/storage',
    'sudo chown -R www-data:www-data /var/www/temuruang/storage',
].join(' ; ');

console.log('🚀 Fixing thumbnails with proper permissions...\n');

const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Connected!\n');
    
    conn.exec(fullCommand, (err, stream) => {
        if (err) throw err;
        
        stream.on('close', (code) => {
            console.log('\n✅ Done! Exit code:', code);
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
