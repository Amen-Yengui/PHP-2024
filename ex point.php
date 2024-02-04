<?php

class Point
{
    private $x;
    private $y;

    public function __construct($x,  $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX(int $x)
    {
        $this->x = $x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY(int $y)
    {
        $this->y = $y;
    }

    public function __toString()
    {
        return "($this->x, $this->y)";
    }
}

class Pixel extends Point
{
    private  $color;

    public function __construct($x,  $y,  $color)
    {
        parent::__construct($x, $y);
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function __toString()
    {
        return parent::__toString() . " [" . $this->color . "]";
    }
}

$point = new Point(10, 20);

echo $point; // (10, 20)

$pixel = new Pixel(10, 20, "red");

echo $pixel; // (10, 20) [red]
