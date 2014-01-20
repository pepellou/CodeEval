<?php

foreach (file($argv[1]) as $line) {
    list($a, $b, $c, $d, $e, $f, $g, $h) = explode(",", trim($line));
    echo ( $a <= $g && $e <= $c && $d <= $f && $h <= $b ) ? "True" : "False";
    echo "\n";
}
