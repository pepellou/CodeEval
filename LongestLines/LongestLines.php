<?php

$lines = file($argv[1]);
$N = trim(array_shift($lines));

$maxs = array();
$maxlines = array();
for ($i = 0; $i < $N; $i++) {
    $maxs[$i] = 0;
    $maxlines[$i] = "";
}

foreach ($lines as $line) {
    $theLine = trim($line);
    if ($theLine != "") {
        $len = strlen($theLine);
        $i = 0;
        while ($i < $N && $maxs[$i] >= $len) {
            $i++;
        }
        if ($i < $N) {
            for ($j = $N - 1; $j > $i; $j--) {
                $maxs[$j] = $maxs[$j-1];
                $maxlines[$j] = $maxlines[$j-1];
            }
            $maxs[$i] = $len;
            $maxlines[$i] = $theLine;
        }
    }
}

foreach ($maxlines as $line) {
    echo "$line\n";
}
