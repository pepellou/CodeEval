<?php

function is_square(
    $n
) {
    $root = floor(sqrt($n));
    return ($root * $root == $n);
}

function get_num_of_sums(
    $n
) {
    $count = 0;
    $root1 = 0;
    while ($root1 * $root1 <= $n / 2) {
        if (is_square($n - $root1 * $root1)) {
            $count++;
        }
        $root1++;
    }
    return $count;
}

foreach (file($argv[1]) as $line) {
    $number = trim($line);
    echo get_num_of_sums($number) . "\n";
}
