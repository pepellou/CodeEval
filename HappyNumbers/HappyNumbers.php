<?php

function nextNumber(
    $n
) {
    $len = strlen($n);
    $sum = 0;
    for ($i = 0; $i < $len; $i++) {
        $sum += $n[$i] * $n[$i];
    }
    return $sum."";
}

function isHappy(
    $n
) {
    $soFar = array();
    while ($n != 1 && !in_array($n, $soFar)) {
        $soFar []= $n;
        $n = nextNumber($n);
    }
    return ($n == 1);
}

foreach (file($argv[1]) as $line) {
    $number = trim($line);
    echo (isHappy($number) ? 1 : 0);
    echo "\n";
}
