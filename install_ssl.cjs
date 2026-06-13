const { Client } = require('ssh2');

const conn = new Client();
const ip = '43.133.154.13';
const username = 'ubuntu';
const password = 'shadow-64$-storm';

conn.on('ready', () => {
    console.log('Menginstall Sertifikat SSL (HTTPS) di VPS...');
    const commands = `
        sudo certbot --nginx -d temuruang.com -d www.temuruang.com --non-interactive --agree-tos -m admin@temuruang.com --redirect
        echo "SSL Installation Completed"
    `;
    
    conn.exec(commands, (err, stream) => {
        if (err) throw err;
        stream.on('close', (code, signal) => {
            console.log('Eksekusi selesai dengan kode: ' + code);
            conn.end();
        }).on('data', (data) => {
            process.stdout.write('' + data);
        }).stderr.on('data', (data) => {
            process.stderr.write('' + data);
        });
    });
}).on('error', (err) => {
    console.error('Koneksi Gagal:', err);
}).connect({
    host: ip,
    port: 22,
    username: username,
    password: password,
    readyTimeout: 99999
});
