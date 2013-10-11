<?php

foreach (file($argv[1]) as $line) {
    $maxWord = "";
    $max = 0;
    foreach(explode(" ", trim($line)) as $word) {
        $len =strlen($word);
        if ($len > $max) {
            $max = $len;
            $maxWord = $word;
        }
    }
    echo "$maxWord\n";
}
