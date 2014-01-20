<?php

class Point {

    public $x, $y;

    public function __construct(
        $x,
        $y
    ) {
        $this->x = $x;
        $this->y = $y;
    }

}

function isSquare(
    $points
) {
    $distances = array();
    for ($i = 0; $i < count($points); $i++) {
        $p1 = $points[$i];
        for ($j = $i + 1; $j < count($points); $j++) {
            $p2 = $points[$j];
            $dx = $p1->x - $p2->x;
            $dy = $p1->y - $p2->y;
            $distances []= $dx * $dx + $dy * $dy;
        }
    }
    sort($distances);
    return ($distances[0] == $distances[1])
        && ($distances[1] == $distances[2])
        && ($distances[2] == $distances[3])
        && ($distances[4] == $distances[5]);
}

function readPoints(
    $line
) {
    foreach (array("(", ")", " ") as $char_to_remove) {
        $line = str_replace($char_to_remove, "", $line);
    }
    $coords = explode(",", $line);
    return array(
        new Point($coords[0], $coords[1]),
        new Point($coords[2], $coords[3]),
        new Point($coords[4], $coords[5]),
        new Point($coords[6], $coords[7])
    );
}

foreach (file($argv[1]) as $line) {
    $points = readPoints(trim($line));
    echo (isSquare($points)) ? "true" : "false";
    echo "\n";
}
