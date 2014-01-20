<?php

function binaryOf(
    $number
) {
    $binary = "";
    while ($number > 0) {
        $reminder = ($number % 2);
        $binary = $reminder . $binary;
        $number = ($number - $reminder) / 2;
    }
    return $binary;
}

foreach (file($argv[1]) as $line) {
    echo binaryOf(trim($line)) . "\n";
}

