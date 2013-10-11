<?php

foreach (file($argv[1]) as $line) {
    $inputLine = trim($line);
    if ($inputLine != "") {
        echo implode(" ", array_reverse(explode(" ", $inputLine)))."\n";
    }
}
