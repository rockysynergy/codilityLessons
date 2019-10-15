<?php

/**
 * The invariant: for sorted array of integers, ...A, B, C... There is triangle only if A + B > C;
 * 
 * For some reason, the code failed one performance testing
 */
function solution($A) {
    $len = count($A);
    if ($len == 0 ) return 0;
    qSort($A, 0, $len - 1);

    for ($i = 0; $i < $len - 2; $i++) {
        if ($A[$i] + $A[$i+1] <= $A[$i+2]) continue;
        else return 1;
    }

    return 0;
}

function qSort(&$A, $lo, $hi)
{
    if ($lo >= $hi) return;
    $j = partition($A, $lo, $hi);
    qSort($A, $lo, $j-1);
    qSort($A, $j+1, $hi);
}

function partition(&$A, $lo, $hi) {
    $v = $A[$lo];
    $i = $lo;
    $j = $hi + 1;

    while (true) {
        while ($A[++$i] < $v) {
            if ($i == $hi) break;
        }

        while ($A[--$j] > $v) {
            // No need any operation
        }

        if ($i >= $j ) break;
        swap($A, $i, $j);
    }

    swap($A, $lo, $j);
    return $j;
}

function swap(&$A, $i, $j) {
    $t = $A[$i];
    $A[$i] = $A[$j];
    $A[$j] = $t;
}

var_dump(solution([1, 1, 2, 3, 5]));