<?php

$array = array();
$len = 1000;
$min = 0;
$max = 1000;
for ($i = 0; $i < $len; $i++) {
    $array[] = mt_rand($min, $max);
}

/**
 * Сортировка пузырьком:
 * 0.099472999572754
 */
function bubbleSort($array) {
    for ($i = 0; $i < count($array) - 1; $i++) {
        for ($j = 0; $j < count($array) - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $tmpArr = $array[$j + 1];
                $array[$j + 1] = $array[$j];
                $array[$j] = $tmpArr;
            }
        }
    }
}

$start_time=microtime(true);
bubbleSort($array);
$end_time=microtime(true);
echo "Сортировка пузырьком: " . $end_time - $start_time . "</br>";


/**
 * Шейкерная сортировка
 * 0.13876986503601
 */
function shakerSort($array) {
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
            list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
            }
        }
        $right -= 1;
        for ($i = $right; $i > $left; $i--) {
            if ($array[$i] < $array[$i - 1]) {
            list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
            }
        }
        $left += 1;
    } while ($left <= $right);
}

$start_time=microtime(true);
shakerSort($array);
$end_time=microtime(true);
echo "Шейкерная сортировка: " . $end_time - $start_time . "</br>";

/**
 * Быстрая сортировка
 * 0.021436929702759
 */
function quickSort($array, $low, $high) {
    $i = $low;                
    $j = $high;
    $middle = $array[ ( $low + $high ) / 2 ];
    do {
        while($array[$i] < $middle) ++$i;
        while($array[$j] > $middle) --$j;
        if($i <= $j) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
            $i++;
            $j--;
        }
    }
    while($i < $j);
    
    if($low < $j) {
        quickSort($array, $low, $j);
    }

    if($i < $high) {
        quickSort($array, $i, $high);
    }
}
$start_time=microtime(true);
quickSort($array, 0, 999);
$end_time=microtime(true);
echo "Быстрая сортировка: " . $end_time - $start_time . "</br>";

/**
 * Пирамидальная сортировка
 * 0.0055110454559326
 */

function heapify(&$arr, $countArr, $i) {
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;

    if ($left < $countArr && $arr[$left] > $arr[$largest])
        $largest = $left;

    if ($right < $countArr && $arr[$right] > $arr[$largest])
        $largest = $right;

    if ($largest != $i) {
        $swap = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $swap;

        heapify($arr, $countArr, $largest);
    }
}

function heapSort(&$arr) {
    $countArr = count($arr);
    for ($i = $countArr / 2 - 1; $i >= 0; $i--)
        heapify($arr, $countArr, $i);
    for ($i = $countArr-1; $i >= 0; $i--) {
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;
        
        heapify($arr, $i, 0);
    }
}

$start_time=microtime(true);
heapSort($array);
$end_time=microtime(true);
echo "Пирамидальная сортировка: " . $end_time - $start_time . "</br>";
