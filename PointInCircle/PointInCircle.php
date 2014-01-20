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

    public static function parse(
        $str
    ) {
        list($name, $coords) = explode(":", $str);
        $coords = str_replace("(", "", $coords);
        $coords = str_replace("(", "", $coords);
        $coords = str_replace(" ", "", $coords);
        list($x, $y) = explode(",", $coords);
        return new Point($x, $y);
    }

    public function sq_distance(
        $another
    ) {
        $dx = $another->x - $this->x;
        $dy = $another->y - $this->y;
        return $dx * $dx + $dy * $dy;
    }

}

class Circle {

    public $center, $radius;

    public function __construct(
        $center,
        $radius
    ) {
        $this->center = $center;
        $this->radius = $radius;
    }

    public function contains(
        $point
    ) {
        return $this->center->sq_distance($point) <= ($this->radius * $this->radius);
    }

}

function parse(
    $line
) {
    list($c, $r, $p) = explode(";", $line);
    $center = Point::parse($c);
    $point = Point::parse($p);
    list($radius_name, $radius_value) = explode(":", $r);
    $radius = trim($radius_value);
    return array(new Circle($center, $radius), $point);
}

foreach (file($argv[1]) as $line) {
    list($circle, $point) = parse(trim($line));
    echo ($circle->contains($point)) ? "true" : "false";
    echo "\n";
}
