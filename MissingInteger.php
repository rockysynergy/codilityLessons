<?php

function solution($A) {
    // write your code in PHP7.0

    $c = [true];
    foreach ($A as $v) {
        if ($v > 0) {
            $c[$v] = true;
        }
    }

    $L = count($A);
    for ($i = 1; $i <= $L+1; $i++) {
        if (!isset($c[$i])) return $i;
    }
}

var_dump(solution([-1]));