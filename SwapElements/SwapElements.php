<?php

foreach (file($argv[1]) as $line) {
    list($numbersPart, $swapsPart) = explode(":", $line);
    $numbers = explode(" ", trim($numbersPart));
    $swaps = explode(",", trim($swapsPart));
    foreach ($swaps as $swap) {
        list($el1, $el2) = explode("-", trim($swap));
        $temp = $numbers[$el1];
        $numbers[$el1] = $numbers[$el2];
        $numbers[$el2] = $temp;
    }
    echo implode(" ", $numbers) . "\n";
}
