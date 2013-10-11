<?php

class Node {

    public $id;
    public $links = array();
    private $bestWay = NULL;
    private $bestWayCount = -1;

    public $letter;

    private static $nodes = array();

    private function __construct(
        $id
    ) {
        $this->id = $id;
    }

    public static function getInstance(
        $pos1,
        $pos2,
        $letter
    ) {
        $id = "$pos1|$pos2";
        if (!isset(self::$nodes[$id])) {
            self::$nodes[$id] = new Node($id);
            self::$nodes[$id]->letter = $letter;
        }
        return self::$nodes[$id];
    }

    public function linkWith(
        $another
    ) {
        if (!in_array($another, $this->links)) {
            $this->links []= $another;
        }
    }

    public function getBestWay(
    ) {
        if (is_null($this->bestWay)) {
            $this->computeBestWay();
        }
        return $this->bestWay;
    }

    public function getBestWayCount(
    ) {
        if (is_null($this->bestWay)) {
            $this->computeBestWay();
        }
        return $this->bestWayCount;
    }

    private function computeBestWay(
    ) {
        if (count($this->links) == 0) {
            $this->bestWayCount = 0;
            $this->bestWay = array($this);
            return;
        }
        $bestNode = $this->selectBestNode($this->links);
        $this->bestWayCount = $bestNode->getBestWayCount() + 1;
        $this->bestWay = $bestNode->getBestWay();
        array_unshift($this->bestWay, $this);
    }

    public static function selectBestNode(
        $nodes
    ) {
        $max = -1;
        $bestNode = NULL;
        foreach ($nodes as $anotherNode) {
            $bestOfAnotherNode = $anotherNode->getBestWayCount();
            if ($bestOfAnotherNode > $max) {
                $max = $bestOfAnotherNode;
                $bestNode = $anotherNode;
            }
        }
        return $bestNode;
    }

}

class Graph {

    public $nodes = array();

    public function addNode(
        $node
    ) {
        $this->nodes[$node->id] = $node;
    }

    public function newLink(
        $info1,
        $info2
    ) {
        $node1 = Node::getInstance($info1->pos1, $info1->pos2, $info1->letter);
        $node2 = Node::getInstance($info2->pos1, $info2->pos2, $info2->letter);
        $this->addNode($node1);
        $this->addNode($node2);
        $node1->linkWith($node2);
    }

}

class Process {

    private $element;

    private function __construct(
        $element
    ) {
        $this->element = $element;
    }

    public static function theString(
        $aString
    ) {
        return new Process($aString);
    }

    public function removeNotContainedIn(
        $anotherString
    ) {
        $result = "";
        $len = strlen($this->element);
        for ($i = 0; $i < $len; $i++) {
            $theChar = $this->element[$i];
            if (strpos($anotherString, $theChar) !== false) {
                $result .= $theChar;
            }
        }
        return $result;
    }

}

class Match {

    public $pos1;
    public $pos2;
    public $letter;

    public function __construct(
        $pos1,
        $pos2,
        $letter
    ) {
        $this->pos1 = $pos1;
        $this->pos2 = $pos2;
        $this->letter = $letter;
    }

}

class Problem {

    public $string1;
    public $string2;

    public function simplify(
    ) {
        $this->string1 = Process::theString($this->string1)
            ->removeNotContainedIn($this->string2);

        $this->string2 = Process::theString($this->string2)
            ->removeNotContainedIn($this->string1);
    }

    public function getPairsOfMatchingPositions(
    ) {
        $matches = array();
        $len1 = strlen($this->string1);
        $len2 = strlen($this->string2);
        for ($i = 0; $i < $len1; $i++) {
            for ($j = 0; $j < $len2; $j++) {
                if ($this->string1[$i] == $this->string2[$j]) {
                    $matches []= new Match($i, $j, $this->string1[$i]);
                }
            }
        }
        return $matches;
    }

}

class ProblemBuilder {

    public static function buildProblem(
        $inputLine
    ) {
        $problem = new Problem();

        list(
            $problem->string1, 
            $problem->string2
        ) = explode(";", $inputLine);

        $problem->simplify();
        return $problem;
    }

}

class ProblemSolver {

    private $problem;

    public function __construct(
        $problem
    ) {
        $this->problem = $problem;
    }

    public function solve(
    ) {
        $graph = $this->buildGraph();

        $bestNode = Node::selectBestNode($graph->nodes);
        foreach ($bestNode->getBestWay() as $step) {
            echo $step->letter;
        }
        echo "\n";
    }

    private function buildGraph(
    ) {
        $matches = $this->problem->getPairsOfMatchingPositions();

        $graph = new Graph();

        foreach ($matches as $match1) {
            foreach ($matches as $match2) {
                if ($match1 != $match2) {
                    $di = $match2->pos1 - $match1->pos1;
                    $dj = $match2->pos2 - $match1->pos2;
                    if ($di > 0 && $dj > 0) {
                        $graph->newLink($match1, $match2);
                    }
                }
            }
        }

        return $graph;
    }

}

foreach (file($argv[1]) as $line) {
    $inputLine = trim($line);
    if ($inputLine != "") {
        $solver = new ProblemSolver(ProblemBuilder::buildProblem($inputLine));
        $solver->solve();
    }
}
