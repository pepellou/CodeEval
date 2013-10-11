<?php

function hex_to_dec(
    $hex
) {
    $len = strlen($hex);
    $dec = 0;
    $multiplier = 1;
    for ($i = $len - 1; $i >= 0; $i--) {
        $dec += $multiplier * strpos('0123456789abcdef', $hex[$i]);
        $multiplier *= 16;
    }
    return $dec;
}

foreach (file($argv[1]) as $line) {
    echo hex_to_dec(strtolower(trim($line))) . "\n";
}
