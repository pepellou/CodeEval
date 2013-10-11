<?php

$numbers = array(
    "zero", "one", "two", "three", "four",
    "five", "six", "seven", "eight", "nine"
);

foreach (file($argv[1]) as $line) {
    foreach (explode(";", trim($line)) as $number) {
        echo array_search($number, $numbers);
    }
    echo "\n";
}
