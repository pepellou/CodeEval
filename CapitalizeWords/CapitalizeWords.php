<?php

foreach (file($argv[1]) as $line) {
    $words = explode(" ", trim($line));
    $capitalized = array();
    foreach ($words as $word) {
        $capitalized []= ucfirst($word);
    }
    echo implode(" ", $capitalized) . "\n";
}
