const {Client} = require('ssh2'); 
const conn = new Client(); 
conn.on('ready', () => { 
  const script = '#!/bin/bash\ncd /var/www/temuruang\nsudo git pull origin main\nsudo php artisan optimize:clear\nsudo chown -R www-data:www-data /var/www/temuruang\n'; 
  const cmds = `echo "${script}" | sudo tee /var/www/temuruang/pull.sh > /dev/null && sudo chmod +x /var/www/temuruang/pull.sh`; 
  conn.exec(cmds, (err, stream) => { 
    if(err) throw err;
    stream.on('close', () => conn.end())
      .on('data', data => console.log(data.toString()))
      .stderr.on('data', data => console.error(data.toString())); 
  }); 
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
