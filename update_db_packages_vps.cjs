const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

console.log('🚀 Menghubungkan ke VPS untuk update database packages...');
const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Terhubung ke VPS! Menjalankan update database packages...');
    
    const cmd = 'cd /var/www/temuruang && php scratch/update_strategic_packages.php';
    
    conn.exec(cmd, (err, stream) => {
        if (err) throw err;
        
        let output = '';
        stream.on('close', (code, signal) => {
            console.log('');
            console.log('✅ Database packages berhasil di-update!');
            console.log('Exit code:', code);
            conn.end();
        }).on('data', (data) => {
            output += data;
            console.log('STDOUT: ' + data);
        }).stderr.on('data', (data) => {
            console.error('STDERR: ' + data);
        });
    });
}).connect(sshConfig);

conn.on('error', (err) => {
    console.error('❌ SSH Error:', err);
});
