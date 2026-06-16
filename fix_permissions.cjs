const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Memperbaiki file permissions untuk Vite assets...");
    const cmds = `
        cd /var/www/hokee
        sudo chown -R www-data:www-data /var/www/hokee
        sudo chmod -R 775 /var/www/hokee/public/build
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            console.log('✅ Perbaikan permission selesai!');
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
