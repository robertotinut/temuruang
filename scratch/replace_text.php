<?php
$file = 'd:/Project/temuruang/resources/views/welcome.blade.php';
$content = file_get_contents($file);

$replacements = [
    'Cleaning and pool service template | Vecuro | Home 1' => 'TemuRuang - Platform Undangan Digital',
    'Cleaning and pool Home 1 template' => 'Platform Undangan Digital Terbaik',
    'Vecuro' => 'TemuRuang',
    'assets_landingpage/img/logo.svg' => 'assets/images/logo.png',
    'assets_landingpage/img/logo-dark.svg' => 'assets/images/logo.png',
    'assets_landingpage/img/logo-white.svg' => 'assets/images/logo-white.png',
    'info@example.com' => 'cs@temuruang.com',
    '+88(0) 1237 6421' => '+62 812 3456 7890',
    'cleaning Services <span class="vs-hero__title--highlight">For</span> your city' => 'Undangan Digital <span class="vs-hero__title--highlight">Untuk</span> Acara Anda',
    'ABOUT CLEANING' => 'TENTANG TEMURUANG',
    'DEEP CLEANING IN YOUR CITY' => 'UNDANGAN DIGITAL TERBAIK',
    'Our Cleaning <span class="title-highlight">Agency</span> For Your City' => 'Platform <span class="title-highlight">Undangan Digital</span> Anda',
    'CLEANING SERVICE' => 'PILIHAN TEMPLATE',
    'Our Excellent Service' => 'Template Premium Kami',
    'cleaning  01' => 'Template',
    'Most Trusted service' => 'Buat Undangan Sekarang',
    'MEET OUR TEAM' => 'PAKET HARGA',
    'We have a expert team' => 'Pilih Paket Sesuai Kebutuhan',
    'LATEST BLOG' => 'FITUR KAMI',
    'Our latest news' => 'Keunggulan TemuRuang',
    'House Cleaning' => 'Ramah Lingkungan',
    'Living Room Cleaning' => 'Desain Eksklusif',
    'cleaning' => 'undangan',
    'Cleaning' => 'Undangan',
    'Get Pricing' => 'Lihat Template'
];

foreach ($replacements as $search => $replace) {
    $content = str_replace($search, $replace, $content);
}

// Replace the menu with a simple one
$menuStart = strpos($content, '<nav class="main-menu menu-style1 d-none d-lg-block">');
$menuEnd = strpos($content, '</nav>', $menuStart) + 6;

if ($menuStart !== false && $menuEnd !== false) {
    $newMenu = '
<nav class="main-menu menu-style1 d-none d-lg-block">
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#template">Template</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="{{ route(\'login\') }}">Login</a></li>
        <li><a href="{{ route(\'register\') }}">Register</a></li>
    </ul>
</nav>';
    $content = substr_replace($content, $newMenu, $menuStart, $menuEnd - $menuStart);
}

// Replace mobile menu
$mobileMenuStart = strpos($content, '<div class="vs-mobile-menu">');
$mobileMenuEnd = strpos($content, '</div>', $mobileMenuStart) + 6;

if ($mobileMenuStart !== false && $mobileMenuEnd !== false) {
    $newMobileMenu = '
<div class="vs-mobile-menu">
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#template">Template</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="{{ route(\'login\') }}">Login</a></li>
        <li><a href="{{ route(\'register\') }}">Register</a></li>
    </ul>
</div>';
    $content = substr_replace($content, $newMobileMenu, $mobileMenuStart, $mobileMenuEnd - $mobileMenuStart);
}

file_put_contents($file, $content);
echo "Done";
