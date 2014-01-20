<?php

class SudokuIterator {

    protected $sudoku;

    public function __construct(
        $sudoku
    ) {
        $this->sudoku = $sudoku;
    }

    public function hasMore(
    ) {
        return false;
    }

    public function nextGroup(
    ) {
        return null;
    }

}

class RowIterator extends SudokuIterator {

    private $currentRow = 0;

    public function hasMore(
    ) {
        return ($this->currentRow < $this->sudoku->N);
    }

    public function nextGroup(
    ) {
        $group = array();
        for ($i = 0; $i < $this->sudoku->N; $i++) {
            $group []= $this->sudoku->data[$this->currentRow * $this->sudoku->N + $i];
        }
        $this->currentRow++;
        return $group;
    }

}

class ColIterator extends SudokuIterator {

    private $currentCol = 0;

    public function hasMore(
    ) {
        return ($this->currentCol < $this->sudoku->N);
    }

    public function nextGroup(
    ) {
        $group = array();
        for ($i = 0; $i < $this->sudoku->N; $i++) {
            $group []= $this->sudoku->data[$i * $this->sudoku->N + $this->currentCol];
        }
        $this->currentCol++;
        return $group;
    }

}

class BlockIterator extends SudokuIterator {

    private $currentBlockRow = 0;
    private $currentBlockCol = 0;
    private $blockSize;

    public function __construct(
        $sudoku
    ) {
        parent::__construct($sudoku);
        $this->blockSize = sqrt($sudoku->N);
    }

    public function hasMore(
    ) {
        return ($this->currentBlockRow < $this->blockSize)
            && ($this->currentBlockCol < $this->blockSize);
    }

    public function nextGroup(
    ) {
        $group = array();
        for ($i = $this->currentBlockRow * $this->blockSize; $i < ($this->currentBlockRow + 1) * $this->blockSize; $i++) {
            for ($j = $this->currentBlockCol * $this->blockSize; $j < ($this->currentBlockCol + 1) * $this->blockSize; $j++) {
                $group []= $this->data[$i * $this->N + $j];
            }
        }
        $this->currentBlockCol++;
        if ($this->currentBlockCol == $this->blockSize) {
            $this->currentBlockCol = 0;
            $this->currentBlockRow++;
        }
        return $group;
    }

}

class Sudoku {

    public $N, $data;

    public function __construct(
        $N,
        $data
    ) {
        $this->N = $N;
        $this->data = $data;
    }

    public function validate(
    ) {
        $iterators = array(
            new RowIterator($this),
            new ColIterator($this),
            new BlockIterator($this)
        );
        foreach ($iterators as $iterator) {
            while ($iterator->hasMore()) {
                if (!$this->validateGroup($iterator->nextGroup())) {
                    return false;
                }
            }
        }
        return true;
    }

    private function validateGroup(
        $group
    ) {
        sort($group);
        for ($i = 0; $i < count($group); $i++) {
            if ($group[$i] != $i + 1) {
                return false;
            }
        }
        return true;
    }

}

class SudokuParser {

    public function parse(
        $input
    ) {
        list($N, $items) = explode(";", $input);
        $data = explode(",", $items);
        return new Sudoku($N, $data);
    }

}

$parser = new SudokuParser();
foreach (file($argv[1]) as $line) {
    $sudoku = $parser->parse(trim($line));
    echo ($sudoku->validate()) ? "True\n" : "False\n";
}
