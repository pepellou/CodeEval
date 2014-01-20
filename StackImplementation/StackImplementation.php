<?php

class Stack {

    private $data = array();

    public function push(
        $element
    ) {
        $this->data []= $element;
    }

    public function pop(
    ) {
        if ($this->isEmpty()) { 
            return null;
        }
        return array_pop($this->data);
    }

    public function isEmpty(
    ) {
        return count($this->data) == 0;
    }

}

foreach (file($argv[1]) as $line) {
    $stack = new Stack();
    foreach (explode(" ", trim($line)) as $number) {
        $stack->push($number);
    }
    $toPrint = array();
    while (!$stack->isEmpty()) {
        $toPrint []= $stack->pop();
        $stack->pop();
    }
    echo implode(" ", $toPrint) . "\n";
}
