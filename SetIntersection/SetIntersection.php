<?php

foreach (file($argv[1]) as $line) {
    list($list1, $list2) = explode(";", trim($line));
    $list1 = explode(",", $list1);
    $list2 = explode(",", $list2);
    $intersection = array();
    foreach ($list1 as $element) {
        if (in_array($element, $list2)) {
            $intersection []= $element;
        }
    }
    echo implode(",", $intersection)."\n";
}
