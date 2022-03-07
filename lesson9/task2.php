<?php

$array = array();
$len = 50;
$min = 0;
$max = 50;
for ($i = 0; $i < $len; $i++) {
    $array[] = mt_rand($min, $max);
}

function deleteEl($array, $value) {
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i] == $value) {
            unset($array[$i]);
        }
    }
    print_r($array);
}

deleteEl($array, 6);
