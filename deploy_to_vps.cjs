const { Client } = require('ssh2');
const fs = require('fs');
const path = require('path');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm',
    readyTimeout: 20000
};

const localBase = __dirname;
const remoteBase = '/var/www/temuruang';

const filesToUpload = [
    'resources/views/templates/wedding/wedding-32.blade.php',
    'insert_wedding_32.php',
    'update_all_db_vps.cjs',
    'scratch/set_fallback_thumbnails.php'
];

// Recursive file reader helper
function getFilesRecursively(dir, fileList = []) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const filePath = path.join(dir, file);
        if (fs.statSync(filePath).isDirectory()) {
            getFilesRecursively(filePath, fileList);
        } else {
            const relPath = path.relative(localBase, filePath);
            fileList.push(relPath);
        }
    }
    return fileList;
}

// Add all files from public/assets/templates/wedding-32 recursively
const assetDir = path.join(localBase, 'public', 'assets', 'templates', 'wedding-32');
if (fs.existsSync(assetDir)) {
    getFilesRecursively(assetDir, filesToUpload);
}

console.log(`🚀 Connecting to VPS to upload ${filesToUpload.length} files...`);

const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Connected! Creating remote folders on VPS...');
    
    // Create the remote gsap subdirectory to avoid SFTP upload errors
    conn.exec('sudo mkdir -p /var/www/temuruang/public/assets/templates/wedding-32/gsap && sudo chown -R ubuntu:ubuntu /var/www/temuruang/public/assets/templates/wedding-32', (err, stream) => {
        if (err) {
            console.error('Error creating directory:', err);
            conn.end();
            return;
        }
        stream.on('close', () => {
            console.log('✅ Remote directories created/checked! Opening SFTP...');
            conn.sftp((err, sftp) => {
                if (err) {
                    console.error('SFTP Error:', err);
                    conn.end();
                    return;
                }

                let index = 0;
                function uploadNext() {
                    if (index >= filesToUpload.length) {
                        console.log('✅ All files uploaded successfully!');
                        console.log('🚀 Running database update and optimize:clear on VPS...');
                        conn.exec('cd /var/www/temuruang && sudo php insert_wedding_32.php && sudo php scratch/set_fallback_thumbnails.php && sudo php scratch/set_more_thumbnails.php && sudo php scratch/set_thumbnails.php && sudo php artisan optimize:clear && sudo chown -R www-data:www-data /var/www/temuruang', (err, execStream) => {
                            if (err) {
                                console.error('EXEC ERROR:', err);
                                conn.end();
                                return;
                            }
                            execStream.on('close', (code) => {
                                console.log('\n✅ VPS DEPLOYMENT AND DB UPDATE COMPLETE! Exit code:', code);
                                conn.end();
                            }).on('data', (data) => {
                                process.stdout.write(data.toString());
                            }).stderr.on('data', (data) => {
                                process.stderr.write(data.toString());
                            });
                        });
                        return;
                    }

                    const relPath = filesToUpload[index];
                    const localPath = path.join(localBase, relPath);
                    const remotePath = `${remoteBase}/${relPath.replace(/\\/g, '/')}`;

                    console.log(`[${index + 1}/${filesToUpload.length}] Uploading ${relPath}...`);
                    sftp.fastPut(localPath, remotePath, (err) => {
                        if (err) {
                            console.error(`❌ FAILED on ${relPath}:`, err.message);
                        } else {
                            console.log(`✅ OK: ${relPath}`);
                        }
                        index++;
                        uploadNext();
                    });
                }
                uploadNext();
            });
        });
    });
}).on('error', (err) => {
    console.error('Connection Error:', err);
}).connect(sshConfig);
