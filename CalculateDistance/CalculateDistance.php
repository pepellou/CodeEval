<?php

foreach (file($argv[1]) as $line) {
    $coords = explode(" ", str_replace(")", "", str_replace(",", "", str_replace("(", "", trim($line)))));
    $dx = $coords[0] - $coords[2];
    $dy = $coords[1] - $coords[3];
    echo sqrt($dx * $dx + $dy * $dy);
    echo "\n";
}
