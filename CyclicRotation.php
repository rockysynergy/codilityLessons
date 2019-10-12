<?php

function solution($A, $K) {
    // write your code in PHP7.0
    if (count($A) == 0) return [];
    
    $len = count($A);
    $C = $len - ($K % $len);

    $re = [];
    for ($i = 0; $i < $len; $i++) {
        $s = ($i + $C) % $len;
        $re[$i] = $A[$s];
    }

    return $re;
}