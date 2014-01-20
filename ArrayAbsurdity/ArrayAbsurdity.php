<?php

function get_duplicated(
    $theArray
) {
    foreach ($theArray as $number) {
        if ($hist[$number])
            return $number;
        $hist[$number] = true;
    }
}

foreach (file($argv[1]) as $line) {
    $theLine = trim($line);
    if ($theLine != "") {
        list($N, $numberList) = explode(";", trim($line));
        $numbers = explode(",", $numberList);
        echo get_duplicated($numbers) . "\n";
    }
}
