<?php

foreach (file($argv[1]) as $line) {
    $integers = explode(",", trim($line));
    $unique = array();
    foreach ($integers as $integer) {
        if (!in_array($integer, $unique)) {
            $unique []= $integer;
        }
    }
    echo implode(",", $unique)."\n";
}
