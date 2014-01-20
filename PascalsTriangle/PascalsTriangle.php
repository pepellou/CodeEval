<?php

class Row {

    public $data = array();

    public function __construct(
        $data = array()
    ) {
        $this->data = $data;
    }

    public function get(
        $index
    ) {
        if ($index < 0 || $index >= count($this->data)) {
            return 0;
        }
        return $this->data[$index];
    }

    public function set(
        $index,
        $value
    ) {
        $this->data[$index] = $value;
    }

}

class Pascal {

    public function getRow(
        $n
    ) {
        if ($n == 1) {
            return new Row(array(1));
        }
        $thePreviousRow = $this->getRow($n - 1);
        $theRow = new Row();
        for ($i = 0; $i < $n; $i++) {
            $theRow->set($i, $thePreviousRow->get($i - 1) + $thePreviousRow->get($i));
        }
        return $theRow;
    }

}

$pascal = new Pascal();
foreach (file($argv[1]) as $line) {
    $numRow = trim($line);
    $result = array();
    for ($i = 1; $i <= $numRow; $i++) {
        $result = array_merge($result, $pascal->getRow($i)->data);
    }
    echo implode(" ", $result) . "\n";
}
