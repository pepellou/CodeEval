<?php

$sum = 0;
foreach (file($argv[1]) as $line) {
    $sum += trim($line);
}
echo "$sum\n";
