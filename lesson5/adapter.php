<?php

interface ICircle
{
    function circleArea(int $circumference);
}

interface ISquare
{
    function squareArea(int $sideSquare);
}

class CircleAdapter implements ICircle
{
    public $circle;

    public function __construct(CircleAreaLib $circle)
    {
        $this->circle = $circle;
    }

    public function circleArea($circumference)
    {
        $diagonal = $circumference / M_PI;
        echo('diagonalC='.$diagonal.'</br>');
        return $this->circle->getCircleArea($diagonal);
    }
}

class SquareAdapter implements ISquare
{
    public $square;

    public function __construct(SquareAreaLib $square)
    {
        $this->square = $square;
    }

    public function squareArea($sideSquare)
    {
        $diagonal = $sideSquare * sqrt(2);
        echo('diagonalS='.$diagonal.'</br>');
        return $this->square->getSquareArea($diagonal);
    }
}

class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
        $area = (M_PI * $diagonal**2)/4;
        return $area;
    }
}

class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
    {
        $area = ($diagonal**2) / 2;
        return $area;
    }
}

$circleLib = new CircleAreaLib();
$circleAdapter = new CircleAdapter($circleLib);
$circleArea = $circleAdapter->circleArea(7); // получается, передаю длину окружности = 4

// $circleArea = $circleLib->getCircleArea(4); // а здесь передавалась бы дигональ = 4

$squareLib = new SquareAreaLib();
$squareAdapter = new SquareAdapter($squareLib);
$squareArea = $squareAdapter->squareArea(5);

echo ($circleArea.'</br>');
echo ($squareArea.'</br>');
