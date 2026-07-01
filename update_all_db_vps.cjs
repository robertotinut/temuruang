const { Client } = require('ssh2');

const sshConfig = {
    host: '43.133.154.13',
    port: 22,
    username: 'ubuntu',
    password: 'shadow-64$-storm'
};

// All database scripts to run in order - using ; to continue even if one fails
const scripts = [
    // 1. Insert all wedding templates (ones with proper Laravel bootstrap)
    'php insert_wedding_01.php',
    'php insert_wedding_02.php',
    'php insert_wedding_21.php',
    'php insert_wedding_22.php',
    'php insert_wedding_23.php',
    'php insert_wedding_24.php',
    'php insert_wedding_25.php',
    'php insert_wedding_26.php',
    'php insert_wedding_27.php',
    'php insert_wedding_28.php',
    'php insert_wedding_29.php',
    'php insert_wedding_30.php',
    'php insert_wedding_31.php',
    'php insert_wedding_32.php',
    // 2. Old-format scripts (may need artisan tinker approach)
    'php insert_wedding_03.php',
    'php insert_wedding_17_20.php',
    // 3. Insert non-wedding and new templates
    'php insert_non_wedding.php',
    'php insert_new_templates.php',
    // 4. Reclassify template categories
    'php reclassify_templates.php',
    // 5. Update template names
    'php scratch/update_template_names.php',
    // 6. Update packages/pricing
    'php scratch/update_strategic_packages.php',
    // 7. Set thumbnails
    'php scratch/set_fallback_thumbnails.php',
    'php scratch/set_more_thumbnails.php',
    'php scratch/set_thumbnails.php',
    'php scratch/fix_three_thumbnails.php',
    // 8. Make all templates premium
    'php scratch/make_all_templates_premium.php',
    // 9. Clear Laravel cache
    'php artisan optimize:clear',
];

// Use ; instead of && so it continues even if one script fails
const fullCommand = 'cd /var/www/temuruang ; ' + scripts.map(s => `echo "\\n>>> Running: ${s}" ; ${s} 2>&1`).join(' ; ');

console.log('🚀 Menghubungkan ke VPS untuk update SEMUA database...');
console.log(`📋 Total ${scripts.length} scripts akan dijalankan.\n`);

const conn = new Client();

conn.on('ready', () => {
    console.log('✅ Terhubung ke VPS! Menjalankan semua database scripts...\n');
    
    conn.exec(fullCommand, (err, stream) => {
        if (err) throw err;
        
        stream.on('close', (code, signal) => {
            console.log('\n========================================');
            console.log('✅ SEMUA database scripts selesai dijalankan!');
            console.log('Exit code:', code);
            console.log('========================================');
            conn.end();
        }).on('data', (data) => {
            process.stdout.write(data.toString());
        }).stderr.on('data', (data) => {
            process.stderr.write(data.toString());
        });
    });
}).connect(sshConfig);

conn.on('error', (err) => {
    console.error('❌ SSH Error:', err);
});
