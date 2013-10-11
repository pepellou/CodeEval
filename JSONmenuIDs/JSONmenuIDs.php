<?php

function has(
    $string,
    $anotherString
) {
    return strpos($string, $anotherString) !== false;
}

foreach (file($argv[1]) as $line) {
    $theJSON = trim($line);
    if ($theJSON != "") {
        $sum = 0;
        list($stuff, $items) = explode("[", $theJSON);
        foreach (explode("{", $items) as $item) {
            if (has($item, "id") && has($item, "label")) {
                list($stuff, $id_with_comma) = (explode(" ", $item));
                list($id) = (explode(",", $id_with_comma));
                $sum += $id;
            }
        }
        echo "$sum\n";
    }
}
