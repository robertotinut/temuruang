const fs = require('fs');
const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

console.log('🚀 Menghubungkan ke VPS...');
const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Terhubung ke VPS! Menarik update dari GitHub...');
    
    conn.exec('sudo /var/www/temuruang/pull.sh', (err, stream) => {
        if (err) throw err;
        
        stream.on('close', (code, signal) => {
            console.log('✅ Update berhasil diterapkan di VPS!');
            conn.end();
        }).on('data', (data) => {
            console.log('STDOUT: ' + data);
        }).stderr.on('data', (data) => {
            console.error('STDERR: ' + data);
        });
    });
}).connect(sshConfig);

conn.on('error', (err) => {
    console.error('❌ SSH Error:', err);
});
