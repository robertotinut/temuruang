<?php

$dir = __DIR__ . '/../public/assets/templates/wedding-01/images';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$images = [
    'image_1.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDP4do8Q2JF-MDbwT1MeWIaE6M6utUbHX_Jnh6LshbynIwPYD4zFIRRm1Cpj3fd0K5ab7j3cnd5ii8YlqFTG9qGEFpPj5V2Yfz_c0hnWpb8OLpVe3WqofdtX_lKIVGRCw9rF3uVBDzbjtwwEt__NZ1YFGGTc4zT3xQAAOU_F-8hs8lPYQuxCNPWhk73G5YqvSEPP2930CUGQXqFZgSGCBeXeI0bF4onzapFGOnvCvuOb7oFhB_ekk0bxCWQ916mnGVeE2sDKaOwSWQ',
    'image_2.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCeIWU80zwZwOuWLxg5l-IMWIrBZ8S6_KVGmN_ooa6C27L3geQoKbHFsBK8JI0Vquw8emD-A-gi8v7RkWJPtVVIyyW1jLOkSW43dGigd4q5VvRkrOZu4vv-MubVjrJ9Rp1o6vDDl5HcvQQd3iWFZBg7XSKYuTVDSRf9_Ho_amKaclIj5uD4ohqMVLFfHV-2EHuAkiVH1e5FEgrQOkgI6SaiMgzCFFRzu4rj6Q272coh0LKC0h2G7Ca7nBzVJjuT424vz_b_k1kU-V4',
    'image_3.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDlwAXM-ql-DyJNrH1u-p196UPB8ABVrtG4m_N3_658EmVS9xT1hi90lp3H2a8pTqvKAkiucOJZaPCEge4OZMivutJQpPjPswot7M7T370pCw0robIja8FgKL0IU02hErzXRu16Q9eGCxkFR12pb8-Ii1XdZjXCrjCb_IIo3wOcycvTCItUTrk4Y5PdWyQQaYcyKZSwgxxcyj-T22E60a4CLVGFQ6NMsiiADRuyemb-j6Jc0PEn844BgvO2rdhEtD4AzuQHOCNoxjo',
    'image_4.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrSntze27x9KPQEu5TQ5qinOJ6soZU0nvHxQEJJvS75ThjoGTQQ2mG2kp935AE99MT7wr469eBTOiqLl6v48EHwfLOM266AydSFqOXaqoeMf8oyDSKVh7OmWBqzBRtIghNrOwHGpQqiZldxEo77K3xl-SKoIZ69rgbrrav6S1XfA4F1vHujnALU-4GX-wjg6rz1Dprse3psS43qm00M8mC1bWS9HneZTNAgjcDHEdcNm9FwiOHO1I7GmG5UkKrIKKEKaAM3JrU5uo',
    'image_5.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDCzu4NKF_UthBKzzw5EklL9Yd2wf5BLfsK97vnvqFVk6CtCxbgcT7zPdPtTt3MvY-SiPoMI7YXQr7TBFpoGVRB4R4L7znt6q2FaQd7_XM8y43HYKeV9F0vNt-KWpjMz9r_2GnU8wG00aFMw2NxNk5BuLDqkrHCulEL6US7RdeG9-6O-uoPo3IunhW9juuBu41ip1gwhQPWen61Ual4f42HmxjoQ-y_amJ0-4WHSIVuXtGyGXs_8VyKYyNMJjsACt2qdW5p4A7PKuU',
    'image_6.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0Exll0MFswn28uaCokYokhw1IEHd9CPUSVDB9RNhfvSmgT9z0jF8E8aew3_Jiab7Ns5wuZ8rCYpoE-nUe0VSkREPTE8z5MkQOkNvHINYDoiODOTLYm5pRBOTbdKYRzOR8po-a4Zz1hwBKD6w-NVDxq5c_KJXsHfQFjYsvYPavXv3gSR83-1KIKfDTznznmqBFaiunvmpU8Q2K_0KhjX66EE1s3fEgcj7ziwIJNcA3DQhE9vgkWVgkVgbUpqY5ss9NeYKGJwSce-c',
    'image_7.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCU4G3P4PwBfokPETgfLHVuvnNEqbD6TUgi6qkuTQ5FUuetBqirFZSh7JxehI_SSynKt9IouDINoVyVY862FJNszjbXeyQowANZaYecAn6r29aYlMN2ThbNcTSLHWoawLyxHxQZHcGdXyaossnt-8cNQdq6Nmgd4BpZFRhmo2R7URESNPgISOUn6YqKR_P5UrUn1urYIsIcgKk3d1Uo5nEHtG1pmaPgQduru3Y1qJpr6UWlmuGUt5SlZDwZ7AcM-ElY9ba01QDTggU'
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
