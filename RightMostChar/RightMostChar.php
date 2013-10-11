<?php

foreach (file($argv[1]) as $line) {
    if (trim($line) != "") {
        list($theString, $theCharacter) = explode(",", trim($line));
        $thePos = strrpos($theString, $theCharacter);
        if ($thePos === false) {
            $thePos = -1;
        }
        echo "$thePos\n";
    }
}
