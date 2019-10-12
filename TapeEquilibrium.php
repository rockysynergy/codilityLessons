<?php

function solution($A) {
    // write your code in PHP7.0

    $sum[0] = $A[0];
    $len = count($A);
    for ($i = 1; $i < $len; $i++) {
        $prev = $i-1;
        $sum[$i] = $sum[$prev] + $A[$i];
    }

    $last = $len - 1;
    $total = $sum[$last];
    $min = INF;
    for ($j = 1; $j < $len; $j++) {
        $tMin = abs(($total - $sum[$j-1]) - $sum[$j-1]);
        if ($tMin < $min) {
            $min = $tMin;
        }
    }

    return $min;
}

var_dump(solution([3, 1, 2, 4, 3]));