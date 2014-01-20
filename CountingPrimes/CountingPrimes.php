<?php

class Primes {

    private static $primes = array(2);

    private static $current = 3;

    public static function computeTo(
        $number
    ) {
        while (self::$current <= $number) {
            $p = 0;
            while ($p < count(self::$primes) && self::$primes[$p] < self::$current / 2 && self::$current % self::$primes[$p] > 0) {
                $p++;
            }
            if (self::$current % self::$primes[$p] > 0) {
                self::$primes []= self::$current;
            }
            self::$current += 2;
        }
    }

    public static function count(
        $from,
        $to
    ) {
        $f = self::indexOf($from);
        $t = self::indexOf($to);
        if (self::$primes[$f] > $to) {
            return 0;
        }
        return $t - $f + 1;
    }

    public static function indexOf(
        $num
    ) {
        $ini = 0;
        $fin = count(self::$primes) - 1;
        while ($ini < $fin) {
            $med = floor(($ini + $fin) / 2);
            if (self::$primes[$med] == $num) {
                return $med;
            }
            if (self::$primes[$med] > $num) {
                $fin = $med - 1;
            } else {
                $ini = $med + 1;
            }
        }
        return $ini;
    }

}

function count_primes(
    $from,
    $to
) {
    Primes::computeTo($to);
    return Primes::count($from, $to);
}

foreach (file($argv[1]) as $line) {
    list($from, $to) = explode(",", trim($line));
    echo count_primes($from, $to) . "\n";
}
