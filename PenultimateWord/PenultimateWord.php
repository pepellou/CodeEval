<?php

foreach (file($argv[1]) as $line) {
    $words = explode(" ", trim($line));
    array_pop($words);
    echo array_pop($words) . "\n";
}
