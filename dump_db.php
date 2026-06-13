<?php
// Simple PHP script to dump database using system calls if possible, or manual export.
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'db_temuruang';
$file = 'temuruang.sql';

// Try to find mysqldump
$paths = [
    'C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe',
    'C:\\laragon\\bin\\mysql\\mysql-5.7.33-winx64\\bin\\mysqldump.exe',
    'C:\\xampp\\mysql\\bin\\mysqldump.exe',
    'mysqldump'
];

$dumped = false;
foreach($paths as $path) {
    if ($path === 'mysqldump' || file_exists($path)) {
        $cmd = "\"$path\" -u $user -h $host $db > $file";
        exec($cmd, $output, $return_var);
        if ($return_var === 0) {
            echo "Successfully dumped using $path\n";
            $dumped = true;
            break;
        }
    }
}

if (!$dumped) {
    echo "Failed to dump database automatically.\n";
}
?>
