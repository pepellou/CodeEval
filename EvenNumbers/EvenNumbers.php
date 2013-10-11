<?php

foreach (file($argv[1]) as $line) {
    echo (1 - trim($line) % 2)."\n";
}
