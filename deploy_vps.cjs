const fs = require('fs');
const { Client } = require('ssh2');

const conn = new Client();
const ip = '43.133.154.13';
const username = 'ubuntu';
const password = 'shadow-64$-storm';

const filesToUpload = [
    { local: 'temuruang.zip', remote: 'temuruang.zip' },
    { local: 'temuruang.sql', remote: 'temuruang.sql' },
    { local: 'setup-vps.sh', remote: 'setup-vps.sh' }
];

console.log('Menghubungkan ke VPS ' + ip + '...');
conn.on('ready', () => {
    console.log('Terhubung! Memulai proses transfer (SFTP)...');
    conn.sftp((err, sftp) => {
        if (err) throw err;
        
        let uploaded = 0;
        
        function uploadNext() {
            if (uploaded >= filesToUpload.length) {
                console.log('Semua file berhasil dikirim. Memulai setup otomatis (mohon tunggu 3-5 menit)...');
                
                // Note: using bash to execute so it streams directly, or just conn.exec
                conn.exec('chmod +x setup-vps.sh && sudo ./setup-vps.sh', (err, stream) => {
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
                return;
            }
            
            const file = filesToUpload[uploaded];
            if (!fs.existsSync(file.local)) {
                console.log(`Peringatan: File ${file.local} tidak ditemukan, lewati.`);
                uploaded++;
                uploadNext();
                return;
            }
            
            console.log(`Mengirim ${file.local}...`);
            sftp.fastPut(file.local, file.remote, (err) => {
                if (err) throw err;
                console.log(`${file.local} berhasil dikirim!`);
                uploaded++;
                uploadNext();
            });
        }
        
        uploadNext();
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
