<?php

function is_self_describing(
    $number
) {
    $hist = array();
    $len = strlen($number);
    for ($i = 0; $i < $len; $i++) {
        $hist[$number[$i]]++;
    }
    $expectedValue = "";
    for ($i = 0; $i < $len; $i++) {
        $expectedValue .= isset($hist[$i]) ? $hist[$i] : 0;
    }
    return $number == $expectedValue;
}

foreach (file($argv[1]) as $line) {
    $number = trim($line);
    echo (is_self_describing($number) ? 1 : 0);
    echo "\n";
}
