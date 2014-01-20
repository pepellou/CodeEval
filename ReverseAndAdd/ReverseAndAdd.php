<?php

function reverseOf(
    $number
) {
    $result = 0;
    while ($number > 0) {
        $lastDigit = ($number % 10);
        $result = 10 * $result + $lastDigit;
        $number = ($number - $lastDigit) / 10;;
    }
    return $result;
}

function solve(
    $number
) {
    $it = 0;
    $reverse = reverseOf($number);
    while ($number != $reverse) {
        $number += $reverse;
        $reverse = reverseOf($number);
        $it++;
    }
    return "$it $number";
}

foreach (file($argv[1]) as $line) {
    $number = trim($line);
    echo solve($number) . "\n";
}
