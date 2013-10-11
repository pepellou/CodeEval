<?php

class HotArea {

    public $minX = 0;
    public $maxX = 40000;
    public $minY = 0;
    public $maxY = 40000;

    public function contains(
        $point
    ) {
        return ($point->x >= $this->minX) && ($point->x <= $this->maxX)
            && ($point->y >= $this->minY) && ($point->y <= $this->maxY);
    }

}

class Point {

    private static $points = array();

    public $x;
    public $y;

    public $hotArea;

    public $nearestPoint = NULL;

    public function __construct(
        $data
    ) {
        list($this->x, $this->y) = $data;
        $this->hotArea = new HotArea();;

        $this->placeOnGrid();
    }

    public function placeOnGrid(
    ) {
        if (count(self::$points) == 0) {
            self::$points []= $this;
            return;
        }
        $hits = array();
        foreach (self::$points as $existingPoint) {
            if ($existingPoint->hotArea->contains($this)) {
                $hits []= $existingPoint;
            }
        }
        if (count($hits) == 0) {
            
        } else if (count($hits) == 1) {
            $this->nearestPoint = 
        } else {
            
        }
    }

}

function solve(
    $points
) {
    foreach ($points as $point) {
        new Point($point);
    }
}

$theInput = file($argv[1]);

$num = array_shift($theInput);
while ($num != 0) {
    $points = array();
    for ($i = 0; $i < $num; $i++) {
        $points[] = explode(" ", array_shift($theInput));
    }
    solve($points);
    $num = array_shift($theInput);
}
