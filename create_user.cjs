const {Client} = require('ssh2');
const conn = new Client();

console.log("🚀 Menghubungkan ke VPS untuk membuat User...");
conn.on('ready', () => {
    const cmds = `
        cd /var/www/hokee
        sudo php artisan tinker --execute="\\App\\Models\\User::firstOrCreate(['email' => 'admin@hokee.web.id'], ['name' => 'Admin Hokee', 'password' => bcrypt('password123')]);"
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => {
            console.log('✅ User dibuat!');
            conn.end();
        }).on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
