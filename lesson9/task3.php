<?php

$array = [6, 45, 67, 6, 0, 32, 11, 2, 7, 89];

/** 
 * Линейный поиск 
*/

function LinearSearch ($myArray, $num) {
    $count = count($myArray);
    $steps = 0;

    for ($i=0; $i < $count; $i++) {
        $steps++;

        if ($myArray[$i] == $num) {
            echo "в линейном поиске: " . $steps . " шагов</br>";
            return $i;
        } elseif ($myArray[$i] > $num) {
            echo "в линейном поиске: " . $steps . " шагов</br>";
            return null;
        }
    }
    return null;
}

/**
 * Бинарный поиск
 */

function binarySearch ($myArray, $num) {
    $left = 0;
    $right = count($myArray) - 1;
    $steps = 0;
    
    while ($left <= $right) {
        $steps++;

        $middle = floor(($right + $left)/2);

        if ($myArray[$middle] == $num) {
            return $middle;
        } elseif ($myArray[$middle] > $num) {
            $right = $middle - 1;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }
    echo "в бинарном поиске: " . $steps . " шагов</br>";
    return null;
}

/**
 * Интерполяционный поиск
 */
function InterpolationSearch($myArray, $num) {
    $start = 0;
    $last = count($myArray) - 1;
    $steps = 0;

    while (($start <= $last) && ($num >= $myArray[$start]) && ($num <= $myArray[$last])) {
        $steps++;

        $pos = floor($start + ((($last - $start) / ($myArray[$last] - $myArray[$start])) * ($num - $myArray[$start])));

        if ($myArray[$pos] == $num) {
            return $pos;
        }

        if ($myArray[$pos] < $num) {
            $start = $pos + 1;
        } else {
            $last = $pos - 1;
        }
    }
    echo "в интерполяционном поиске: " . $steps . " шагов</br>";
    return null;
}

LinearSearch($array, 32);
binarySearch($array, 32);
InterpolationSearch($array, 32);
