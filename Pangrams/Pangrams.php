<?php

function get_missing(
    $sentence
) {
    $sentence = strtolower($sentence);
    $missing = array();
    foreach (explode(" ", "a b c d e f g h i j k l m n o p q r s t u v w x y z") as $aChar) {
        if (strpos($sentence, $aChar) === false) {
            $missing []= $aChar;
        }
    }
    return count($missing) == 0 ? "NULL" : implode($missing);
}

foreach (file($argv[1]) as $line) {
    $sentence = trim($line);
    if ($sentence != "") {
        echo get_missing($sentence) . "\n";
    }
}
