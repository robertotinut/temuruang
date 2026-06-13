<?php
$dir = new RecursiveDirectoryIterator('d:/Project/temuruang/resources/views');
$ite = new RecursiveIteratorIterator($dir);

foreach($ite as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getRealPath();
        $content = file_get_contents($path);
        
        $new_content = str_replace('cs@temuruang.com', 'roberto.bagas7@gmail.com', $content);
        $new_content = str_replace('Tuesday - Saturday 8:00 Am - 5:00 Pm', 'Layanan 24 Jam', $new_content);
        $new_content = preg_replace('/href="[^"]*\.html"/', 'href="#"', $new_content);
        
        if ($new_content !== $content) {
            file_put_contents($path, $new_content);
            echo "Updated " . $path . "\n";
        }
    }
}
?>
