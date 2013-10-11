<?php

function solve(
    $string
) {
    list($letters, $numbers) = explode("|", $string);
    foreach (explode(" ", $numbers) as $number) {
        echo $letters[$number - 1];
    }
    echo "\n";
}

foreach (file($argv[1]) as $line) {
    if (trim($line) != "") {
        solve(trim($line));
    }
}
