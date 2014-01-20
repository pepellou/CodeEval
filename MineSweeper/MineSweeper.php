<?php

class MineCounter {

    private $m, $n, $data;

    public function __construct($m, $n, $data) {
        $this->m = $m;
        $this->n = $n;
        $this->data = $data;
        $this->result = str_replace(".", "0", $data);
    }

    public function count() {
        for ($row = 0; $row < $this->m; $row++) {
            for ($col = 0; $col < $this->n; $col++) {
                if ($this->data[$row + $this->n * $col] == "*") {
                    $neighbours = array(
                        array($row, $col - 1),
                        array($row, $col + 1),
                        array($row - 1, $col),
                        array($row - 1, $col - 1),
                        array($row - 1, $col + 1),
                        array($row + 1, $col),
                        array($row + 1, $col - 1),
                        array($row + 1, $col + 1)
                    );
                    foreach ($neighbours as $neighbour) {
                        list($x, $y) = $neighbour;
                        if ($x >= 0 && $y >= 0 && $x < $this->n && $y < $this->m && $this->result[$x + $this->n * $y] != "*") {
                            $this->result[$x + $this->n * $y] = $this->result[$x + $this->n * $y] + 1;
                        }
                    }
                }
            }
        }
        return $this->result;
    }

    private function cellAt($row, $col) {
        return $this->data[$row * $this->n + $col];
    }

}

foreach (file($argv[1]) as $line) {
    list($dimensions, $data) = explode(";", trim($line));
    list($m, $n) = explode(",", $dimensions);
    $mineCounter = new MineCounter($m, $n, $data);
    echo $mineCounter->count()."\n";
}
