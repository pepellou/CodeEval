<?php

class Condition {

    private $value;

    public function __construct(
        $value
    ) {
        $this->value = $value;
    }

    public function ugly(
    ) {
        foreach (array(2, 3, 5, 7) as $uglifier) {
            if (Is($this->value)->multipleOf($uglifier)) {
                return true;
            }
        }
        return false;
    }

    public function multipleOf(
        $anotherNumber
    ) {
        return ($this->value % $anotherNumber == 0);
    }

}

function Is($what) {
    return new Condition($what);
}

class State {

    public $toSolve;
    public $totalLength;
    public $currentPos = 0;
    public $currentResult = 0;
    public $currentOperator = "";
    public $currentSign = 1;

    public $nextDigit;
    public $restToSolve;
    public $updatedResult;

    public $hash;

    public function __construct(
        $toSolve,
        $totalLength,
        $currentPos = 0,
        $currentResult = 0,
        $currentOperator = "",
        $currentSign = 1
    ) {
        $this->toSolve = $toSolve;
        $this->totalLength = $totalLength;
        $this->currentPos = $currentPos;
        $this->currentResult = $currentResult;
        $this->currentOperator = $currentOperator;
        $this->currentSign = $currentSign;

        $this->nextDigit = $this->toSolve[$this->currentPos];
        $this->updatedResult = $this->currentResult + $this->currentSign * ($this->currentOperator . $this->nextDigit);

        $this->hash = "$currentResult|$currentPos|$currentOperator|$currentSign";
    }

    public function noop(
    ) {
        return new State(
            $this->toSolve,
            $this->totalLength,
            $this->currentPos + 1,
            $this->currentResult, 
            $this->currentOperator.$this->nextDigit,
            $this->currentSign
        );
    }

    public function plus(
    ) {
        return new State(
            $this->toSolve,
            $this->totalLength,
            $this->currentPos + 1,
            $this->updatedResult,
            "", 
            1
        );
    }

    public function minus(
    ) {
        return new State(
            $this->toSolve,
            $this->totalLength,
            $this->currentPos + 1,
            $this->updatedResult,
            "",
            -1
        );
    }

    public function isFinal(
    ) {
        return $this->currentPos == $this->totalLength - 1;
    }

}

class UglyCounter {

    public $count = 0;

    private $cache = array();

    public function check(
        $number
    ) {
        if (!isset($this->cache[$number])) {
            $this->cache[$number] = Is($number)->ugly();
        }
        if ($this->cache[$number]) {
            $this->count++;
        }
    }

}

class StateExplorer {

    private static $cache = array();

    private $counter;

    public function __construct(
        $counter
    ) {
        $this->counter = $counter;
    }    

    public function explore(
        $state
    ) {
        if (isset(self::$cache[$state->hash])) {
            $this->counter->count += self::$cache[$state->hash];
            return;
        }

        $countBefore = $this->counter->count;
        $this->processState($state);
        $countAfter = $this->counter->count;

        self::$cache[$state->hash] = $countAfter - $countBefore;
    }

    private function processState(
        $state
    ) {
        if ($state->isFinal()) {
            $this->counter->check($state->updatedResult);
        } else {
            $this->explore($state->noop());
            $this->explore($state->plus());
            $this->explore($state->minus());
        }
    }

    public static function clearCache(
    ) {
        self::$cache = array();
    }

}

class UglyNumbers {

    private static $counter = NULL;

    public static function solve(
        $digits
    ) {
        self::initCounter();
        StateExplorer::clearCache();
        $solver = new StateExplorer(self::$counter);
        $solver->explore(new State($digits, strlen($digits)));
        return self::$counter->count;
    }

    private static function initCounter(
    ) {
        if (is_null(self::$counter)) {
            self::$counter = new UglyCounter();
        } else {
            self::$counter->count = 0;
        }
    }

}

foreach (file($argv[1]) as $digits) {
    echo UglyNumbers::solve(trim($digits)) . "\n";
}
