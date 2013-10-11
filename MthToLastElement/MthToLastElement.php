<?php

foreach (file($argv[1]) as $line) {
    $theList = explode(" ", trim($line));
    $index = array_pop($theList);
    if ($index <= count($theList)) {
        echo $theList[count($theList) - $index]."\n";
    }    
}
