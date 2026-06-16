const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS...");
conn.on('ready', () => {
    console.log("✅ Terhubung! Menginstall Node.js & Membangun Asset Vite...");
    const cmds = `
        curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
        sudo apt-get install -y nodejs
        cd /var/www/hokee
        sudo npm install
        sudo npm run build
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            console.log('✅ Instalasi Node.js dan Build Asset Selesai!');
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
