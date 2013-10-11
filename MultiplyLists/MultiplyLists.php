<?php

foreach (file($argv[1]) as $line) {
    list($l1Part, $l2Part) = explode("|", trim($line));
    $list1 = explode(" ", trim($l1Part));
    $list2 = explode(" ", trim($l2Part));
    $result = array();
    for ($i = 0; $i < count($list1); $i++) {
        $result []= $list1[$i] * $list2[$i];
    }
    echo implode(" ", $result) . "\n";
}
