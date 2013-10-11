<?php

class Board {

    public $cells = array();

    public function __construct(
    ) {
        for ($row = 0; $row < 256; $row++) {
            $newRow = array();
            for ($col = 0; $col < 256; $col++) {
                $newRow []= 0;
            }
            $this->cells []= $newRow;
        }
    }

}

class Query {

    protected $parameters;

    public function __construct(
        $parameters
    ) {
        $this->parameters = $parameters;
    }

}

class QuerySetRow extends Query {

    public function run(
        $board
    ) {
        list($i, $x) = $this->parameters;
        for ($col = 0; $col < 256; $col++) {
            $board->cells[$i][$col] = $x;
        }
    }

}

class QuerySetCol extends Query {

    public function run(
        $board
    ) {
        list($j, $x) = $this->parameters;
        for ($row = 0; $row < 256; $row++) {
            $board->cells[$row][$j] = $x;
        }
    }

}

class QueryGetRow extends Query {

    public function run(
        $board
    ) {
        $i = $this->parameters[0];
        $sum = 0;
        for ($col = 0; $col < 256; $col++) {
            $sum += $board->cells[$i][$col];
        }
        echo "$sum\n";
    }

}

class QueryGetCol extends Query {

    public function run(
        $board
    ) {
        $j = $this->parameters[0];
        $sum = 0;
        for ($row = 0; $row < 256; $row++) {
            $sum += $board->cells[$row][$j];
        }
        echo "$sum\n";
    }

}

class QueryBuilder {

    public static function getQuery(
        $queryString
    ) {
        $queryParts = explode(" ", $queryString);

        $command = array_shift($queryParts);
        $parameters = $queryParts;

        if ($command == "SetRow") {
            return new QuerySetRow($parameters);
        }
        if ($command == "SetCol") {
            return new QuerySetCol($parameters);
        }
        if ($command == "QueryRow") {
            return new QueryGetRow($parameters);
        }
        if ($command == "QueryCol") {
            return new QueryGetCol($parameters);
        }
    }

}

$board = new Board();
foreach (file($argv[1]) as $line) {
    $query = QueryBuilder::getQuery(trim($line));
    $query->run($board);
}
