<?php

function solve(
    $theString
) {
    $n = strlen($theString);
    $matches = array();
    for ($i = 0; $i < $n; $i++) {
        $matchLine = array();
        for ($j = 0; $j < $n; $j++) {
            $matchLine[$j] = ($j > $i && $theString[$i] == $theString[$j]);
        }
        $matches [$i]= $matchLine;
    }
    $bestMatch = "";
    $bestMatchLength = 0;
    for ($offset = 1; $offset <= $n; $offset++) {
        $matching = false;
        $match_length = 0;
        $match_start = 0;
        for ($i = 0; $i < $n - $offset; $i++) {
            $j = $i + $offset;
            if ($matches[$i][$j]) {
                if (!$matching) {
                    $match_start = $i;
                }
                $matching = true;
                $match_length++;
            } else {
                if ($matching) {
                    $match_length = min(array($match_length, $offset));
                    if ($match_length > $bestMatchLength) {
                        $theMatch = "";
                        for ($j = $match_start; $j < $match_start + $match_length; $j++) {
                            $theMatch .= $theString[$j];
                        }
                        if (trim($theMatch) != "") {
                            $bestMatch = $theMatch;
                            $bestMatchLength = $match_length;
                        }
                    }
                }
                $matching = false;
                $match_length = 0;
            }
        }
        if ($matching) {
            $match_length = min(array($match_length, $offset));
            if ($match_length > $bestMatchLength) {
                $theMatch = "";
                for ($j = $match_start; $j < $match_start + $match_length; $j++) {
                    $theMatch .= $theString[$j];
                }
                if (trim($theMatch) != "") {
                    $bestMatch = $theMatch;
                    $bestMatchLength = $match_length;
                }
            }
        }
    }
    if ($bestMatchLength == 0) {
        return "NONE";
    }
    return $bestMatch;
}

foreach (file($argv[1]) as $line) {
    echo solve(trim($line)) . "\n";
}
