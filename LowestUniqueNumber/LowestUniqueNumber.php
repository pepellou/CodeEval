<?php

foreach (file($argv[1]) as $line) {
    $numbers = explode(" ", trim($line));
    $hist = array();
    foreach ($numbers as $number) {
        $hist[$number]++;
    }
    asort($hist);
    $keys = array_keys($hist);
    if ($hist[$keys[0]] > 1) {
        echo "0\n";
    } else {
        echo 1 + array_search($keys[0], $numbers)."\n";
    }
}
