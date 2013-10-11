<?php

class Fibonacci {

    private $f = array(0, 1, 1);

    public function get(
        $n
    ) {
        if (!isset($this->f[$n])) {
            $this->f[$n] = $this->get($n - 1) + $this->get($n - 2);
        }
        return $this->f[$n];
    }

}

$fibonacciNumbers = new Fibonacci();

foreach (file($argv[1]) as $line) {
    echo $fibonacciNumbers->get(trim($line))."\n";
}
