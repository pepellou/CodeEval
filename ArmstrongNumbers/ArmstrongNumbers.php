<?php

function isArmstrong(
    $number
) {
    $n = strlen($number);
    $sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $sum += pow($number[$i], $n);
    }
    return $sum == $number;
}

foreach (file($argv[1]) as $line) {
    echo (isArmstrong(trim($line))) ? "True" : "False";
    echo "\n";
}
