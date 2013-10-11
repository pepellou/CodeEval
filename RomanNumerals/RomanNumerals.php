<?php

function romanOf(
    $number
) {
    $output = "";
    $values = array(
        array("M", 1000),
        array("CM", 900),
        array("D", 500),
        array("C", 100),
        array("XC", 90),
        array("L", 50),
        array("X", 10),
        array("IX", 9),
        array("V", 5),
        array("I", 1)
    );
    $current_value = 0;
    while ($number > 0) {
        while ($values[$current_value][1] > $number) {
            $current_value++;
        }
        $output .= $values[$current_value][0];
        $number -= $values[$current_value][1];
    }
    return $output;
}

foreach (file($argv[1]) as $line) {
    $number = trim($line);
    echo romanOf($number)."\n";
}
