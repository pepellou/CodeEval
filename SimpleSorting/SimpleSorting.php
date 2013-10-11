<?php

foreach (file($argv[1]) as $line) {
    $numbers = explode(" ", trim($line));
    sort($numbers);
    echo implode(" ", $numbers) . "\n";
}
