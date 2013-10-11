<?php

function isDigit(
    $aString
) {
    $len = strlen($aString);
    for ($i = 0; $i < $len; $i++) {
        $theChar = $aString[$i];
        if ($theChar < '0' || $theChar > '9') {
            return false;
        }
    }
    return true;
}

foreach (file($argv[1]) as $line) {
    $list = explode(",", trim($line));
    $words = array();
    $digits = array();
    foreach ($list as $element) {
        if (isDigit($element)) {
            $digits []= $element;
        } else {
            $words []= $element;
        }
    }
    echo implode(",", $words);
    if ((count($words) > 0) && (count($digits) > 0)) {
        echo "|";
    }
    echo implode(",", $digits);
    echo "\n";
}
