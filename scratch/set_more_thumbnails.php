<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;
use Illuminate\Support\Facades\Storage;

$thumbnails = [
    'wedding-09' => 'https://lh3.googleusercontent.com/aida/AP1WRLuxkvRG1zdRZokQHxMuUBxIKAmxtGmebqVhTJ-rbJPN-M0MqvPXVapYoqh-eYqSnP009F3b9q3L04wpe9HWzL2LHz9ALIH6avc_AKiVppVAmpjDCeiQxxp4F5JLzHUdt8-L1oEUSkGr_Hz_znUnjByJ3A2v3os84pEEtRXd399E39AC9TYZUYV9BQjypKGVzKFyCdgJ9h0zdwJG-5uJwPGdbEYnhUQpGFVUU-Pkduu9D3whBNGkn9DMABU',
    'wedding-11' => 'https://lh3.googleusercontent.com/aida/AP1WRLudYB7c8Z096v9DWBNKbZYg3kIkYXaymf3nIWMlE_i8u30WV770YzLsrNcbAMWrNQHPPbI6Uc7oFWuYVzqdXZZ1Vh7x8-iGQh9niTYtcgszpUDXkv1nB_Y1qaxXPCqzG23rUMCsI5hT8C8uIvIQQ6jvbTzhYvol1CPcSC0-WXEJVlDf-VMiVYokJC4zbgvjZJWI5mTGJP6e2KXhwW3E8wdYz183nOckVRQmU02fQXhTVIZyKptbbNZwB_0',
    'wedding-13' => 'https://lh3.googleusercontent.com/aida/AP1WRLs35B41ke3htPvJZHmXcr44c_rAFyvaODcQ35BdgJAmSSFag2a2eN2GJab63sMPNY7DjpMrLpNjRpTTTHPIP2QwfVUkToy_0wxINkgwRWxeWp004QazJs5TYdn8pgeBbpRaXLUY41e_Bx_VQc5ao3V6g_HR3yihN4zUUHu-X9FM0y2sYe1g9yrI6d-ZPfiMRthDllE9wAMrErC9mQw167TgfDIJ6B-XVdOuKkX3CPqn9x4usb6lD_LMblvp',
    'wedding-14' => 'https://lh3.googleusercontent.com/aida/AP1WRLv3vdGaIuDjifYvM74_LwqCTja5WyjMdIfwMuVwNJEsZwQM8PpOpzPC9bxA6CB78JZSOGK6a8WZlparojsV_lnwMaGSi4ShAw-ZYbXEyEUKhNvU2yeAo9n6g-SzmRm4seHpDycWMv4gjsykwzDxQl93GwAWDmvhjSMvuUuDWPJHpwF9w1bQSIY79TRa6c63oWlIxvi1uG2BxwMkOHAcg8SAoc9AkCXOPiT8zu-j_cwgP6S-WNUry6JgrVsq',
    'wedding-15' => 'https://lh3.googleusercontent.com/aida/AP1WRLtgn1VuATCyUUEOERzIFN-waVzK0kymKXGPekKxqfG-ojnqEW-sr2OSQyqqUjyv8NcXOwGznGDIqBjehu7ZomtxkzSHYBo59O9Ztw7dNnP1iW_2V5y0JbmY0enG-HI-wTrsTaUg_G_JxHOZpROoJED4l2KEecS5d_xBIKhPjwfVqutjRdu_Rq4R6Zi8jQ61x3reqyo8Ce52tozvIizhFLXy5mfi0QU5V1Zud58O8i-BQtERmm40bPdd6iua',
    'wedding-16' => 'https://lh3.googleusercontent.com/aida/AP1WRLsLrcpxiGSPW7phHzmJwDmdElH5BUcTocpqp0slSIxShnT9-Fwz4WN3w0Y36A8QW09rb5URsHeXLyuN1DI1rpVKDdhJOgL31zsna8dKMToAbj3202Jh0cjviEgQ6BNi1FNSni885qWxm1zeAghjX110fdnmTZCbWwrc7O3JVOv-j6RS-a58cPg-pIrZRCad7XNjCAUeWAASCYWGJIKWRbP63j6x9X0DJNbXgE9ddEi2ix-RdRjs2NiG-lQ',
    'wedding-17' => 'https://lh3.googleusercontent.com/aida/AP1WRLu8IXKkcMJSzOpbqDNDQJTS0J1FwF3Xx8iVWUlxrM0l9v1TBunxCV2bUPfYQdITMuaJ2Vu7xHN_Hjl1IEYXfz4r4Y1GAx0RbFBbhhFVcpzbYzW9mQnddJxTZeB_55NX6YAK81vGYMrzTKU20WnZqo_QtUY0kUc0hkK5ImtSLkL4_315LgRlADesqjKTJPB5B1ALa15fdGCQAB6UjNHfyitQcnxWGrmnsiERcn5Cf7_HVO_cJeYxUJN8T-0',
    'wedding-18' => 'https://lh3.googleusercontent.com/aida/AP1WRLuZvunTyImt3G2h1jJczXiVYBQUNNIo-ixCakaqhl_wN9Zr34JTNDEQsxJymwht-_28_0ssPFmyKEMjBdqe2monWidyIsSzxX06oNxIHGNyRP4hTsrR9Ij0U0REWf64_MOuKJ-w5OafzWFdrZMTVaDhG7-Yqos8E67pH6FY_wfoaM9NthuOhj6fk8zcwkVTDCZzS6i_GAHhQwby71n21h9QpCCBn5N3d3exEsd04W9tbEx_FAkAmaPewLE',
    'wedding-21' => 'https://lh3.googleusercontent.com/aida/AP1WRLtzu3b-McosrD8KTjoYVopKWig0d_yk9bRegIc56R-2VYckKaFRXOK5ZbuLKnZ5iG1Rz09-ifuDAIYLWFVBXbLvd7TxR5AKhbQFYBiMIMSvxBu_1V-JxlIn2PbG8n2BAGAOT6k7vGNDj1rIhBXACFXpR897a2Di78LeGQcm6we68ZRrjfN810FLqPSKziJ82uvIaY6aTpRprPpjRo-iqGUE0gqxHVTP3_eVABddz4zMTVg7EG-SWhIeGmI',
    'wedding-22' => 'https://lh3.googleusercontent.com/aida/AP1WRLtKwdC4yr1KXQmN3_Atvvxlor0imZQAgrMWIFZVqWSmzabTAMVzYz875l8vk4R2E6qhQIg3g-cSjy22TSx_jDntelwIzaD4CJdcKAWYBfnXycj1OSiC8iTezNenv3b6ssmSDNcRDoOkqWIJrHUPcKXmd5eM45D12ow6qYC1nzzHpvZhivvK3SamwMj8lglF7ZkT21VJWzxcAeqpLQ8wnXI8SO7sBjudYCslbUowFof-wzAwViaYaPXlxw',
    'wedding-23' => 'https://lh3.googleusercontent.com/aida/AP1WRLtOXX1DSTYEyHEcYngvo33gdxAnzl8gSmbHjz4t7dWRFiBp4MZKxrYr8nAwgqyypONzOsXWp7OBP9fP2soVT8nt2OQgnuleD4gVXqhPKIOs91G0SJT1hYhaKfPbgvkMkv7UHe62Pi0WXC6Hd-imh2THN_ceSuUvKVi-2KNY8w0AwQqgJ3ytKFkxEgLnIEcePoD05BZdT5fxOW2TnttxDgFlaae5VtjhGGDbzCzekOj70udGjEfQ4ITIWoc',
    'wedding-24' => 'https://lh3.googleusercontent.com/aida/AP1WRLu5CbNSwq5KYaHMMPk3mc6U7oiLzgkNnAQTxU3_8PW-H8jkWvNxv-tIEj6vHGVvVEu_AqsRdL3vo24OoEtnnrinyaBwIZVI4bGtyHr0nJyq_T5GnCPrVKQUtf4R7DL1CjjM_aGNwxGn9DuQvYZfHhfSyY7cyMALICFtrdO_epGD6qrsYT69gDvm00417IgHZ4yuH6pYqWGuq11Vg5O2Lb1KK_cxuekxo3MP6R8FXUDREA0czrPDFyAY6GI',
    'wedding-25' => 'https://lh3.googleusercontent.com/aida/AP1WRLt-vAsq6HuyWaQfGqotCAWF7STNY9k1eEAh8lF6rsvNW-UCzyV0WXP8CNuInN_fkMh2VwSDIc8zT6AegVADtOHeFl92XmLrlh4E5tGZUwK3hYp7hPTV05yw59CtpRttsssu7I1fSZNHSJfzEUgs38DG1iQWSdKzc-CsCvGUU4WSqX3qmCy7dZhLfkgCmsWI7UfvAM4STx-CY8GO0g8hw-LRwR9Y7INFYICMZ6Lk8knd2LRPQlKiYcn4wQ',
    'wedding-27' => 'https://lh3.googleusercontent.com/aida/AP1WRLu48bgz5U7-TEmdrtLxa_IiRlPgml-5VJr_V14XpnlH5-rMFcvQWtig2N7POAXAPx6cMBP8ZsdxRENSEZJVais2aV0T00Adivl5c7627l0lGA5u_VmSsxjcszVl5_4qCMJCmXswSzlKj2mWg5pSJ52Pat8-IAKtP0tzdUB74iQeW-6qbf1NceqDopHgf7fvA26kIsejA9XAmfuukX-s9DFxRS5tM5q6RolBOpHd8AZwwIAuvXPShlkKzxy3',
    'wedding-31' => 'https://lh3.googleusercontent.com/aida/AP1WRLuLw-Aeq5aV3Lrd8XaoSptaDVoLcSBdzXVlxpOWQPAC8QR4-ug63k0AfUuzLZmXP8d4E0ue0aLpHQCasJbha82ozFEYTtB6aKEpH4_4-q_XXatYhsHfXyqYYUyRGdpp_V7zqWHj1v8gHZHype1wepjKQsdsES1AGCLbqhq6iMOo9xKTy_3lYORZWWp2MBk5yQv_m6n5zZkeH01QFKsR0dSBofH_Fd6HApi59_zFq2bwNkD8YFZ3g4Nit2jM',
];

$dir = storage_path('app/public/templates/thumbnails');
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "Created directory: $dir\n";
}

// Ensure the storage symlink exists
$link = public_path('storage');
if (!file_exists($link)) {
    echo "Symlink public/storage does not exist, attempting to create...\n";
    try {
        Artisan::call('storage:link');
        echo "Artisan storage:link output: " . Artisan::output() . "\n";
    } catch (\Exception $e) {
        echo "Failed to create symlink: " . $e->getMessage() . "\n";
    }
}

foreach ($thumbnails as $slug => $url) {
    $template = Template::where('slug', $slug)->first();
    if (!$template) {
        echo "Template $slug not found in database.\n";
        continue;
    }

    $filename = "{$slug}.jpg";
    $path = "{$dir}/{$filename}";

    echo "Downloading thumbnail for {$slug}...\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    $data = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo "Error downloading for {$slug}: " . curl_error($ch) . "\n";
    } else {
        file_put_contents($path, $data);
        $dbPath = "templates/thumbnails/{$filename}";
        $template->thumbnail = $dbPath;
        $template->save();
        echo "Saved to $path and updated DB for {$slug} (" . strlen($data) . " bytes)\n";
    }
    curl_close($ch);
}

echo "All additional thumbnails processed successfully.\n";
