<?php

function beautyOfString(
    $aString
) {
    $len = strlen($aString);
    $hist = array();
    for ($i = 0; $i < $len; $i++) {
        if ($aString[$i] >= "a" && $aString[$i] <= "z") {
            $hist[$aString[$i]]++;
        }
    }
    arsort($hist);
    $current_val = 26;
    $sum = 0;
    foreach ($hist as $count) {
        $sum += $current_val * $count;
        $current_val--;
    }
    return $sum;
}

foreach (file($argv[1]) as $line) {
    $sentence = trim($line);
    echo beautyOfString(strtolower($sentence))."\n";
}
