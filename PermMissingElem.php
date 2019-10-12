<?php

function solution($A) {
    // write your code in PHP7.0
    $c = count($A);
    $b = [];
    for ($i = 1; $i <= $c+1; $i++) {
        array_push($b, $i);
    }

    $re = array_diff($b, $A);
    return (array_values($re)[0]);
}
var_dump(solution([2, 3, 1, 5]));