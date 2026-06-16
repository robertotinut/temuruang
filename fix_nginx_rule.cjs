const {Client} = require('ssh2');
const conn = new Client();

const nginxConfig = `server {
    server_name hokee.web.id www.hokee.web.id;
    root /var/www/hokee/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \\.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\\.(?!well-known).* {
        deny all;
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/hokee.web.id/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/hokee.web.id/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}
server {
    if ($host = hokee.web.id) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    listen 80;
    server_name hokee.web.id www.hokee.web.id;
    return 404; # managed by Certbot
}
`;

console.log("🔧 Memperbaiki konfigurasi Nginx...");
conn.on('ready', () => {
    console.log("✅ Terhubung!");
    const base64 = Buffer.from(nginxConfig).toString('base64');
    const cmds = `
        echo "${base64}" | base64 -d | sudo tee /etc/nginx/sites-available/hokee > /dev/null
        sudo nginx -t && sudo systemctl restart nginx && echo "✅ Nginx OK dan sudah restart!"
    `;
    conn.exec(cmds, (err, stream) => {
        if (err) throw err;
        stream.on('close', () => conn.end())
          .on('data', data => process.stdout.write(data.toString()))
          .stderr.on('data', data => process.stderr.write(data.toString()));
    });
}).connect({host: '43.133.154.13', username: 'ubuntu', password: 'shadow-64$-storm'});
