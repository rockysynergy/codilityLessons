<?php

function solutionA($X, $Y, $D) {
    // write your code in PHP7.0
    if ($X == $Y) return 0;

    $re = 0;
    for ($i = $X; $i + $D < $Y; $i += $D) {
        $re++;
    }

    return $re+1;
}

function solution($X, $Y, $D) {
    // write your code in PHP7.0
    if ($X == $Y) return 0;

    return (int)ceil(($Y-$X)/$D);
}
