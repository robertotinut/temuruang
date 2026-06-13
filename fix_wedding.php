<?php
$path = "d:\\Project\\temuruang\\resources\\views\\templates\\wedding\\wedding-02.blade.php";
$lines = file($path);

$new_lines = array_slice($lines, 0, 684);
$script_lines = array_slice($lines, 1012, 140);
$new_lines = array_merge($new_lines, $script_lines);
$new_lines[] = "</body>\n</html>\n";

file_put_contents($path, implode("", $new_lines));
echo "Fixed successfully!";
?>
