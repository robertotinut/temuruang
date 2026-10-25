const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm',
    readyTimeout: 30000,
};

function execCmd(conn, cmd) {
    return new Promise((resolve, reject) => {
        conn.exec(cmd, (err, stream) => {
            if (err) return reject(err);
            let stdout = '';
            let stderr = '';
            stream.on('data', (d) => { stdout += d.toString(); });
            stream.stderr.on('data', (d) => { stderr += d.toString(); });
            stream.on('close', (code) => {
                resolve({ code, stdout, stderr });
            });
        });
    });
}

const conn = new Client();

conn.on('ready', async () => {
    try {
        console.log('1. Connected to VPS. Pulling latest changes from GitHub...');
        const pullCmd = [
            'cd /var/www/temuruang',
            'sudo -n cp -f resources/views/templates/forcustomer/wedding-11.blade.php /tmp/forcustomer_w11.bak || true',
            'sudo -n git config --global --add safe.directory /var/www/temuruang',
            'sudo -n git fetch origin main',
            'sudo -n git reset --hard origin/main',
            'sudo -n cp -f /tmp/forcustomer_w11.bak resources/views/templates/forcustomer/wedding-11.blade.php || true',
            'sudo -n chown -R www-data:www-data /var/www/temuruang/storage /var/www/temuruang/public/assets/templates /var/www/temuruang/resources/views',
            'git log -1 --oneline',
        ].join(' && ');

        const res1 = await execCmd(conn, pullCmd);
        console.log(res1.stdout || res1.stderr);

        console.log('2. Updating VPS database templates table...');
        const sql = `
            UPDATE templates SET thumbnail = CONCAT('templates/thumbnails/', slug, '.jpg');
            UPDATE templates SET theme_category = 'Modern & Elegan' WHERE slug = 'wedding-32';
            INSERT INTO templates (event_type_id, name, slug, thumbnail, preview_image, description, is_premium, is_active, theme_category, created_at, updated_at)
            SELECT 1, 'Lestari Royal Heritage', 'wedding-33', 'templates/thumbnails/wedding-33.jpg', 'templates/thumbnails/wedding-33.jpg',
                   'Kemegahan adat Jawa Keraton bernuansa dark espresso & antique gold, berpadu ornamen gapura, wayang, ronce melati, serta animasi kunang-kunang dan kupu-kupu emas.',
                   1, 1, 'Tradisional (Jawa, Sunda, dll)', NOW(), NOW()
            WHERE NOT EXISTS (SELECT 1 FROM templates WHERE slug = 'wedding-33');
            UPDATE templates SET
                name = 'Lestari Royal Heritage',
                thumbnail = 'templates/thumbnails/wedding-33.jpg',
                preview_image = 'templates/thumbnails/wedding-33.jpg',
                is_active = 1,
                is_premium = 1,
                theme_category = 'Tradisional (Jawa, Sunda, dll)'
            WHERE slug = 'wedding-33';
            UPDATE templates SET is_active = 0 WHERE slug = 'wedding-new-1';
            SELECT id, slug, name, thumbnail, is_active FROM templates ORDER BY id;
        `;
        const res2 = await execCmd(conn, `mysql -u admin -ppassword123 db_temuruang -e ${JSON.stringify(sql)}`);
        console.log(res2.stdout || res2.stderr);

        console.log('3. Running migrations, ensuring storage symlink & clearing Laravel caches on VPS...');
        const res3 = await execCmd(conn, [
            'cd /var/www/temuruang',
            'sudo -n -u www-data php artisan migrate --force',
            'sudo -n -u www-data php artisan storage:link || true',
            'sudo -n -u www-data php artisan optimize:clear',
            'ls -1 /var/www/temuruang/storage/app/public/templates/thumbnails/*.jpg | wc -l',
        ].join(' && '));
        console.log(res3.stdout || res3.stderr);

        console.log('✅ VPS Deployment Complete!');
        conn.end();
    } catch (e) {
        console.error('Error:', e);
        conn.end();
        process.exit(1);
    }
}).connect(sshConfig);
