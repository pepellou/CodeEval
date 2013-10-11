<?php

$contents = file_get_contents($argv[1]);
$len = strlen($contents);
for ($i = 0; $i < $len; $i++) {
    $theChar = $contents[$i];
    if ($theChar >= 'a' && $theChar <= 'z') {
        $theChar = strtoupper($theChar);
    } else if ($theChar >= 'A' && $theChar <= 'Z') {
        $theChar = strtolower($theChar);
    }
    echo $theChar;
}
