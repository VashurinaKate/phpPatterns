<?php

$exp = "7+9*2+10/5"; // 27

function arrayExp(string $input) {
    $exp = str_split($input);
    $expArray = [];
    $temp = '';

    foreach ($exp as $v) {
        if ( $v != '+' && $v != '-' && $v != '*' && $v != '/') {
            $temp .= $v;
        } else {
            $expArray[] = $temp;
            $temp = '';
            $expArray[] = $v;
        }
    }
    $expArray[] = $temp;

    return $expArray;
}

function getOperatorPosition($exp) {
    if (in_array('+', $exp)) return array_search('+', $exp);
    if (in_array('-', $exp)) return array_search('-', $exp);
    if (in_array('*', $exp)) return array_search('*', $exp);
    if (in_array('/', $exp)) return array_search('/', $exp);
    return false;
}


// Считаем
function calculate(array $exp) {
    $pos = getOperatorPosition($exp);
    if (!$pos) return $exp[0];

    $left = array_slice($exp, 0, $pos);
    $right = array_slice($exp, $pos + 1);

    switch ($exp[$pos]) {
        case '+':
            return calculate($left) + calculate($right);
        case '-':
            return calculate($left) - calculate($right);
        case '*':
            return calculate($left) * calculate($right);
        case '/':
            return calculate($left) / calculate($right);
    }
}

$expArray = arrayExp($exp);
echo calculate($expArray);
