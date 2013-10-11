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

    public function check(
        $number
    ) {
        if (Is($number)->ugly()) {
            $this->count++;
        }
    }

}

class StateExplorer {

    private $counter;

    public function __construct(
        $counter
    ) {
        $this->counter = $counter;
    }    

    public function explore(
        $state
    ) {
        if ($state->isFinal()) {
            $this->counter->check($state->updatedResult);
            return;
        }
        $this->explore($state->noop());
        $this->explore($state->plus());
        $this->explore($state->minus());
    }

}

class UglyNumbers {

    public static function solve(
        $digits
    ) {
        $counter = new UglyCounter();
        $solver = new StateExplorer($counter);
        $solver->explore(new State($digits, strlen($digits)));
        return $counter->count;
    }

}

foreach (file($argv[1]) as $digits) {
    echo UglyNumbers::solve(trim($digits)) . "\n";
}
