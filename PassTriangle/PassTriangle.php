<?php

$previousLevel = null;

foreach (file($argv[1]) as $line) {
    $currentLevel = explode(" ", trim($line));

    $n = count($currentLevel);

    for ($i = 0; $i < $n; $i++) {
        if (!is_null($previousLevel)) {
            $p1 = ($i == 0) ? 0 : $previousLevel[$i-1];
            $p2 = ($i == $n - 1) ? 0 : $previousLevel[$i];
            $currentLevel[$i] += ($p1 > $p2) ? $p1 : $p2;
        }
    }

    $previousLevel = $currentLevel;
}

echo max($currentLevel) . "\n";
