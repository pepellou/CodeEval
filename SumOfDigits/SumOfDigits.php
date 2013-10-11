<?php

foreach (file($argv[1]) as $line) {
    $number = trim($line);
    $len = strlen($number);
    $sum = 0;
    for ($i = 0; $i < $len; $i++) {
        $sum += $number[$i];
    }
    echo "$sum\n";
}
