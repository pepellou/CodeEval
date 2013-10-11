<?php

class BitNumber {

    private $number;

    public function __construct(
        $number
    ) {
        $this->number = $number;
    }

    public function bitAt(
        $position
    ) {
        return ($this->number >> ($position - 1)) % 2;
    }

}

foreach (file($argv[1]) as $line) {
    $inputLine = trim($line);

    list($n, $p1, $p2) = explode(",", $inputLine);

    $bitNumber = new BitNumber($n);

    echo (($bitNumber->bitAt($p1) == $bitNumber->bitAt($p2)) ? "true" : "false") . "\n";
}
