<?php

function is_open(
    $char
) {
    return in_array($char, array("(", "[", "{"));
}

function matches(
    $open,
    $close
) {
    return ($open == "(" && $close == ")")
        || ($open == "[" && $close == "]")
        || ($open == "{" && $close == "}");
}

function check(
    $str
) {
    $len = strlen($str);
    $stack = array();
    for ($i = 0; $i < $len; $i++) {
        $theChar = $str[$i];
        if (is_open($theChar)) {
            $stack []= $theChar;
        } else {
            $matching = array_pop($stack);
            if (!matches($matching, $theChar)) {
                return false;
            }
        }
    }
    return count($stack) == 0;
}

foreach (file($argv[1]) as $line) {
    echo check(trim($line)) ? "True" : "False";
    echo "\n";
}
