<?php

foreach (file($argv[1]) as $line) {
    $inputLine = trim($line);
    list($x, $n) = explode(",", $inputLine); 
    $sum = $x + $n;
    $count = 0;
    while ($n > 1) {
        $sum = $sum >> 1;
        $n = $n >> 1;
        $count++;
    }
    while ($count > 0) {
        $sum = $sum << 1;
        $count--;
    }
    echo $sum;
    echo "\n";
}
