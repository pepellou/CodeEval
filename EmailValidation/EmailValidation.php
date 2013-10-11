<?php

foreach (file($argv[1]) as $line) {
    if (trim($line) != "") {
        echo (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,4}$/", trim($line))) ? "true" : "false";
        echo "\n";
    }
}
