<?php

function solution($A) {
    $tMax = count($A) > 0 ? $A[0] : 0;
    $fMax = $tMax;

    $L = count($A);
    for ($i= 1; $i < $L; $i++) {
        $tMax = $tMax < 0 ? 0: $tMax;
        $tMax += $A[$i];

        if ($tMax > $fMax) {
            $fMax = $tMax;
        }
    }

    return $fMax;
}

$a = [3, 2, -6, 4, 0];
$a = [];
$a = [-10];
$a = [-2, 1];
$a = [-20, -30, -50];
$a = [-40, -30, -50];
var_dump(solution($a));