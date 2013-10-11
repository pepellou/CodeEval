<?php

class Prime {

    public $value;

    private static $known_primes = array();

    public function __construct(
        $value
    ) {
        $this->value = $value;
        self::$known_primes []= $value;
    }

    public function next(
    ) {
        $newValue = $this->value + 2;
        while (!Prime::isPrime($newValue)) {
            $newValue += 2;
        }
        return new Prime($newValue);
    }

    public function lessThan(
        $aNumber
    ) {
        return $this->value < $aNumber;
    }

    private static function isPrime(
        $value
    ) {
        if (in_array($value, self::$known_primes)) {
            return true;
        }
        for ($i = 0; $i < count(self::$known_primes); $i++) {
            $prime = self::$known_primes[$i];
            if ($value % $prime == 0) {
                return false;
            }
        }
        self::$known_primes []= $value;
        return true;
    }

}

class Primes {

    public static function upTo(
        $max
    ) {
        $result = array(2);
        $prime = new Prime(3);
        while ($prime->lessThan($max)) {
            $result []= $prime->value;
            $prime = $prime->next();
        }
        return $result;
    }

}

foreach (file($argv[1]) as $line) {
    $max = trim($line);
    echo implode(",", Primes::upTo($max)) . "\n";
}
