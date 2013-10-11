<?php

class Permutations {

    private static $cache = array();

    public static function getForString(
        $aString
    ) {
        if (!isset(self::$cache[$aString])) {
            $len = strlen($aString);
            if ($len == 1) {
                self::$cache[$aString] = array($aString);
            } else {
                $results = array();
                for ($i = 0; $i < $len; $i++) {
                    $first = $aString[$i];
                    $rest = substr($aString, 0, $i) . substr($aString, $i + 1);
                    foreach (Permutations::getForString($rest) as $aPermOfRest) {
                        $results []= $first . $aPermOfRest;
                    }       
                }
                self::$cache[$aString] = $results;
            }
        }
        return self::$cache[$aString];
    }

}

function permutationsOf(
    $aString
) {
    $len = strlen($aString);
    $strArray = array();
    for ($i = 0; $i < $len; $i++) {
        $strArray []= $aString[$i];
    }
    sort($strArray);
    $aString = implode("", $strArray);
    return implode(",", Permutations::getForString($aString));
}

foreach(file($argv[1]) as $line) {
    echo permutationsOf(trim($line)) . "\n";
}
