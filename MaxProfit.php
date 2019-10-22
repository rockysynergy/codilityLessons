<?php

function solution($A) {
    $diffs = [];

    $L = count($A);
    for ($i = 1; $i < $L; $i++) {
        $diffs[$i-1] = $A[$i] - $A[$i-1];
    }

    $fMax = 0;
    $tMax = 0;
    for ($i = 0; $i < $L - 1; $i++) {
        $tMax += $diffs[$i];
        if ($tMax < 0) $tMax = 0;
        if ($tMax > $fMax) {
            $fMax = $tMax;
        }
    }

    return $fMax;
}

$a = [23171, 21011, 21123, 21366, 21013, 21367];
$a = [];
$a = [12];
var_dump(solution($a));