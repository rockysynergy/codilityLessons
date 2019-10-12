<?php

function solution($S, $P, $Q) {
    // write your code in PHP7.0
    $SL = strlen($S);
    $A = [];
    $C = [];
    $G = [];
    $T = [];

    for ($i = 0; $i < $SL; $i++) {
        $el = $S[$i];
        if ($el == 'A') array_push($A, $i);
        if ($el == 'C') array_push($C, $i);
        if ($el == 'G') array_push($G, $i);
        if ($el == 'T') array_push($T, $i);
    }

    $M = count($P);
    $v = [];
    for ($j = 0; $j < $M; $j++) {
        $start = $P[$j];
        $end = $Q[$j];

        if (($re = inRange($A, 0, count($A)-1, $start, $end)) > -1) $re = 1;
        else if (($re = inRange($C, 0, count($C)-1, $start, $end)) > -1) $re = 2;
        else if (($re = inRange($G, 0, count($G)-1, $start, $end)) > -1) $re = 3;
        else if (($re = inRange($T, 0, count($T)-1, $start, $end)) > -1) $re = 4;

        array_push($v, $re);
    }
    return $v;
}

function inRange($arr, $lo, $hi, $start, $end) {
    if ($lo > $hi) return -1;

    $mid = floor(($lo+$hi)/2);
    if ($arr[$mid] >= $start && $arr[$mid] <=$end) return $mid;
    else if ($arr[$mid] > $end) return inRange($arr, $lo, $mid - 1, $start, $end);
    else if ($arr[$mid] < $start) return inRange($arr, $mid + 1, $hi, $start, $end);
}

solution('CAGCCTA', [2, 5, 0], [4, 5, 6]);