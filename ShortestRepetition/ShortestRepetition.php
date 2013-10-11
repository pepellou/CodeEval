<?php

function stringHasPeriod(
    $string,
    $period
) {
    $len = strlen($string);
    if ($len % $period != 0) {
        return false;
    }
    $numReps = $len / $period;
    for ($i = 1; $i < $numReps; $i++) {
        for ($j = 0; $j < $period; $j++) {
            if ($string[$j] != $string[$j + $i * $period]) {
                return false;
            }
        }
    }
    return true;
}

function shortestRepetition(
    $aString
) {
    $periodCandidate = 1;
    while ($periodCandidate < 41) {
        if (stringHasPeriod($aString, $periodCandidate)) {
            return $periodCandidate;
        }
        $periodCandidate++;
    }
    return 0;
}

foreach (file($argv[1]) as $line) {
    $theString = trim($line);
    echo shortestRepetition($theString) . "\n";
}
