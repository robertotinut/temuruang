<?php

$dir = __DIR__ . '/../public/assets/templates/wedding-02/images';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$images = [
    'image_1.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCGF4wn5unWKavC0dxteSbTuT6OWdrVsP-LLLNbwzF5QPHz5p6XZRzROoP9drMTkJr_p2A5oondtA7lFKzKKj7yCqPCzNwN3mgngaV1dJIcK4Yy0Hf4Owi4c51FkIB_1LZUkgxqtu1S3Ci2jCI_77S4AS8ZHh_tRrG1_ril8VbttZ3RpKnoGbB9xofWdWTFiC3SPz0uBlEm49RWBKfK4X4AciwEBtvuxyYKQE-ajt9Pm3NY8Z7D4CMgTymj2B313Uw-VAVjYztFh64',
    'image_2.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAiihk7KLGq1Zk-_pPREhGDfZd30Gn9QS99ECFnHuzxhaaETmlLrdbmgaonfBJwpSR1ggvTvrfDbXnxSiO0qnYlBX_aeQ7bMjwd15o930PacykkQzQ6e9OvydVRwZHmVF8FchcSKa_LNwVgHV1a2_Ns3vY9ABAWhM2_b7mfzDA2QIBvxKA-M228-JZ1080BQs-NkH5T_ArNCwwQF7ZTdy-C_W9FhCYOdwmmbje45zg7Bbey6tPwTSuuAU0kbIjsa97SNSPioGh7wQQ',
    'image_3.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA2MUmRqBhyrDWLzM4cFnpVrBi0bshyhu7eIC8LAxHLEdWxBXAX5wTgwjS2VXAhgqN3Aju4ZmUI5JCXGSBqE2DZgKv_v5_ic_lD3yG-9bo4NiYCof2BiR-pI8pfSRuJienQSTJ0nvSarX1CU9nkX0l8KRbo15uWWjKCVsI5xVxK4Kxu_xee4JJIFPAENnJ16EREgeoylnh7y69eLX14gXfWSV9GBoeQR9vJwnZITmYiruNM05m6nipLr27qaU3N7k8Hq88866oR4sw',
    'image_4.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDXp68I8OqUPFXDt9ZhK1gH1jRx0LkledQiZnMH1xiD-VEURZ3UY_QxLRMFYSUwk2gkZiwg5dKiedLmxYUyRxLDXjZ4QKwM1TNTk6SjX7xTIYMtXdsXCE_50-zHsuwxy-6GKkPG28OJgcb63TXKkHWLlrnnJr05jt8ti_otyzR4t0xrR2GNH-CoyFqs1tFkKHvSV3g4v-YD3tY8G9UqOs6OOnygz_RnkaaY7kqXwTRZUlJ1ca3TvilyUtlqDtJc8tQ1LKIjqc_TlBc',
    'image_5.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuApdaV07hnyNzRx9BSp5vwhWcK1w-geEUMiZo9FcO5LtQoQuQBvETfg5IPtFVzGV1zEO0fDQX_vtUoR-q6VvZ0qrXMCuKUFMP2lwf7NjToCvuLaNGMmaJLivVc_fqc5zaC_F9xdRIgKfA_6lK3_SAvy9wppdhDR8GmLLKnUdznbYKg7cTf1TLLOFGmIIHJARv6rT8qHFh9BEIYb_fi_hdNH4C0hvRRl-50Y1DEKYnifp9qqaqYIblMEHravLTkIfQgNiy9XWtdFyxI',
    'image_6.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDGm7tzeOTCxXDv-1uCNJSfG59d9apCA_bo0KH_8iamaBreexlxFJDdyvPovyrKOv2tuB3xt319c3hajU4UxLVWkh-fXB5iVKIdNy3FUWkeXGfA8UNF5FuPrDavqjT1YuHRnsO8lBQxLXBdS-kq_IkFyELYMn0ckGUFGSqSCLa1U95u3LXwiiax_NWD08Ij70gV_NBsttpQfiyEE2XERkXws_JusiXap2D6yV2Z3neaOU2hyJKgk3KHwhakNDps41_AhGdWvAXu0vM',
    'image_7.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDND3QvEVD10odjVTc9RH1nikAfhNPMP98XDNMdRhrjejKEQxfTwvT-KQBrX_MbuiPVOzd_nLGNhVVymo1uTqW_BpXlLhlsZ47x6uWDzPcaQYdgOIlBQBhV8uavqdlVbZKpQe6Z19qq_ZUBaW6xCNQKks573hXPBB5cUuX2Q-rG-llADRs_fVwjqL222wl4RuGztaUUYvA-6K5QZSb0kxTtCMKWTrO8YZJtN9EApU0y5TRGcMwilpOUuqq8Ta6zyIkhN-iSBUjoIsE',
    'image_8.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBr1a5wojyBbiwpeD_3-YadV1mW_PHysavujuoHRePTq_ar934YNY3HrNhavJ2D5yRncRxpHbeHslC1WHM_3H0BRw30viHLRdk4PRZSm7lkpi9MqQlMYbnIdcPGym9c-9RG80VcdMcMEMHZRsp5UW2O7KcA5C5ZQSKiwp6_0ZOzwXpGhD9xqdaVO-YAPXOqswgdScKf0C5zR_02qV7JATqT2oBKfxn-mpABaFb9ZAXBOsE94DKJJ9rtO2fh0H5kjJbv_F3rTkLcVs8',
    'image_9.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAHLU0q-dP0TEsCxkqwNDMU6NALtdGPSEli4VSdi2hO_MjmS01HWlyYnVzOInPe2aE44zfZcHQwZC13CNKPIR65PI6HkK1APYluB5BoaUwq934hyVTq55Lz_ZJkYQ2XOzwUFvmGMHVGXThZXfrqZLKt2WkPkDaYk9Ps9eqf0Qg8rqUKZrVDLwg36aSzJyUCQEgbgp8Bj7xM6LVPStZ1IiDyy_9DMoNPKvnoZ5iWY3EQf3l2lJfyc6Z48nXq50hvVjCbCbPVPbULd7w'
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
