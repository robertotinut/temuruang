<?php

$dir = __DIR__ . '/../public/assets/templates/wedding-30/images';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$images = [
    'image_1.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRwh4BsoU9HTJ9134sRnZrYNAGsRFYtdOhHZYFwFtHRGuoYyV_hNFXOp4_qFl-SslcWGj0RRf3bFcC0zX0J8xgDBNjFkRRNIcvHeAKhIwaY3mDLeR3OKwkXc_seogs0yMxZ85rsZabT3YcT19JwjBoqoEP9j8FMecL5ScIMgIxFcwxP98LHE9kUnj1hIODRZsusiSuYssRt7nYsoUTrMIDjkbVMaNmtvsR9_5TT_MwWI1Jax1mEamJG7Tnus7oINUiXaGG0INK8iy_',
    'image_2.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDIe1dDTTYC-78-daOjuerXeQd-AGRSY04ym66XdRuIDjWN_Vn45Xlcw7xtv3P7AFPnDO_TgANxAJf8Jiv1TWNE6F0PW7eiIilGljqcQQmTyV50WEyD5nHP5njjbyDyUoEiDWLPs69dLqykW2nTTkkDdcnAm_QtsbU_ZzBO6JNWpNbvUoaHhhOF97muLtPTt9cjEJ9_LCou5ZehCWAGtb_J2frFyDMgo6omquwc9nJbWYUzX5CMtspj7O6fBt6IlVkZ-oup8ehHzPGZ',
    'image_3.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAfcBUOor7UI3ndoYJqBb3P_GovFAvixEPtKBrwP7fFzLnsaPnIXUKxzlk07OUHjMQQ6tjXRAWq9BI1lWBen7aUGYkGRLhaP0fHowctOh6da12PpsxH4BvAevZGQgr_XVRlEOYU2wGoczTKvEyAwsVxL2qqVHUKZVc-WlJgcDYJYPn0ikuVgmndTer0wutwvOOf37m2kS13zcKqUZB47cfZAL27pQXuAETrRh0iaS8fy74VhMLWRiCqDS_M4w7zNISlBIcT19KFx90a',
    'image_4.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuACRzMRqlKSaGBMp_M_8Nklg8Xu52gWqonWC70tdKKBN4I7lvX-1s2UQHfK80cIe79fZeO7K5-vFrQpVGGULoj4Sl0kqwzwUqk2g1PBisdKjbo7TR7nT9mannpOjax0oTeKZFkR2bZyUPodCGHvwp9-kJcfKZOrdnq2xnXFc1xa7UgAbMepfr96i9rlgRX2CL_-Mp7ytn4Ze9j6Jdf3XnJDtNbcEFUTRwExYR4QJtBJI6YhH1S485P7NZ-x6_ZOueeRRw5dFKeMUJJ2',
    'image_5.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAW8yCOIxF-ClbW1O2tFywnChOcP8yxFEtZvOZl7SDFZAFLrcK4qONAzO_zy9QL2gDUUFvvgT0T4qYgVShnJbAhtTw-mPLx9vrgkA6A5kbmRr85izHVcMAaHd0Lp9up71bJzs7uBvXeXimzv0yUDKuq4kRzKq6Gbx7p0MEtqfRaxrxy7tgyE7D-KnrShl-1U4odg93adjv7THoiNqbCLdMZsINkreem5KpSpGJtCBkhI9Nop_G0oILz7WkCF--JoM7AAV4SAMcojs2u',
    'image_6.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqJa9WXWYhziTc_UTxSifDfrsUWOyQKXyARn4KF0HUKXbanJsMs7OsXmJVvdnRE8IlNuCyPjNuqg2Yio0CoHBWXe6PYnY88LH6Jp8rK3RBYYnvau9tsOgr1ls9ay_RWVOVnrOXYV4MiO3iFyHPV73pc5cS7XlR1bdTJdQEkx7afVhimM8ZNn4zGQbayCEPKT49wlPlVBcV-jXIXLm8xr7jDyXf2rKX1I5zzQlI4opu3M_zjSyk1Mn7WhAnXSiiAPGgNquj3oVao2B-',
    'image_7.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBOgYDfEZdKV8TDqPqJFdUNHzMDqCUn4utMo6SGdqcI_gj0wEu75TMrGqH4iVlA2_oyhtaoymJLi0YjcBDIfHgsLNwrTw4bGJURYHmSbTYPhZHu8M8GPFXydCKoOzDZG5bVS5_e64NxTajyUBG7EqOKkYWc0rZ5INum9w2HgTfFR34ch6YwCKa3cu03zKXe-N8uW3H1dbdMHrELDzQfTRPMFC_1n6bCo8GOcZRK2xxeIu0OJpF1uPqdgP_bApt0b1qs1j8-bmGnLWfN',
    'image_8.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuASkQDkjqbB2pT1aPZourE1jwltvvKdTpKHgYf9R8vdQUKK1SDq2QyHaTP_IQZ6k_o6aZR1qEXwQvOLKGnt6QsWniriAP5p7PwR51G6Fiq6irg2Zs4nlv3IcbModOGBw2Z_FKwr_YUcwb1Q8QoTvrffdo_IXjkOMSnYYDHSe9mK_wDqGkVvT4G89WCLj13FmTj7MBsKTEwsPn9FKRRcf2UE2iATUsLBf9275_SB33vU1Da7TruWJDDVwd38E27dc1unrmXK-CoJliXe'
];

foreach ($images as $filename => $url) {
    $path = "$dir/$filename";
    echo "Downloading $filename...\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "Error downloading $filename: " . curl_error($ch) . "\n";
    } else {
        file_put_contents($path, $data);
        echo "Saved to $path (" . strlen($data) . " bytes)\n";
    }
    curl_close($ch);
}

echo "Downloads complete.\n";
