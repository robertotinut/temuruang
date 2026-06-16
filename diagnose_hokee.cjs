const {Client} = require('ssh2');
const conn = new Client();

console.log("🔍 Menghubungkan ke VPS untuk diagnosa...");
conn.on('ready', () => {
    console.log("✅ Terhubung!");
    const cmds = `
        echo "=== 1. Cek file build ==="
        ls -la /var/www/hokee/public/build/
        ls -la /var/www/hokee/public/build/assets/
        
        echo "=== 2. Cek Nginx error log ==="
        sudo tail -20 /var/log/nginx/error.log
        
        echo "=== 3. Cek Nginx config hokee ==="
        sudo cat /etc/nginx/sites-available/hokee
        
        echo "=== 4. Cek owner seluruh folder public ==="
        ls -la /var/www/hokee/public/
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
