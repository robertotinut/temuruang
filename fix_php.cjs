const {Client} = require('ssh2');
const conn = new Client();
conn.on('ready', () => {
    const cmds = 'sudo sed -i "s/php8.3-fpm.sock/php8.2-fpm.sock/g" /etc/nginx/sites-available/hokee && sudo systemctl restart nginx';
    conn.exec(cmds, (err, stream) => {
        stream.on('close', () => {
            console.log('Fixed Nginx config and restarted Nginx');
            conn.end();
        }).on('data', data => console.log(data.toString()))
          .stderr.on('data', data => console.error(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
