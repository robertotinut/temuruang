const { Client } = require('ssh2');

const command = process.argv[2] || 'echo CONNECTION_OK && hostname && whoami && pwd';

const conn = new Client();
conn.on('ready', () => {
  console.log('=== CONNECTED TO VPS ===');
  conn.exec(command, (err, stream) => {
    if (err) { console.error('EXEC ERROR:', err); conn.end(); return; }
    let output = '';
    stream.on('close', (code) => {
      console.log(output);
      console.log('=== EXIT CODE:', code, '===');
      conn.end();
    }).on('data', (data) => {
      output += data.toString();
    }).stderr.on('data', (data) => {
      output += '[STDERR] ' + data.toString();
    });
  });
}).on('error', (err) => {
  console.error('CONNECTION ERROR:', err.message);
}).connect({
  host: '43.133.154.13',
  port: 22,
  username: 'ubuntu',
  password: 'shadow-64$-storm',
  readyTimeout: 10000,
});
