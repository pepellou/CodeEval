<?php

function ones(
    $number
) {
    $ones = 0;
    while ($number > 0) {
        $reminder = ($number % 2);
        $ones += $reminder;
        $number = ($number - $reminder) / 2;
    }
    return $ones;
}

foreach (file($argv[1]) as $line) {
    echo ones(trim($line)) . "\n";
}
