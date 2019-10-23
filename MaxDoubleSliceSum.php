<?php

function solution($A)
{
    $tMax = count($A) > 0 ? $A[0] : 0;
    $fMax = $tMax;

    $fStart = 0;
    $fEnd = 0;
    $start = 0;
    $end = 0;

    $L = count($A);
    for ($i = 1; $i < $L; $i++) {
        if ($tMax < 0) {
            $tMax = 0;
            $start = $i;
            $end = $i;
        } else {
            $tMax += $A[$i];
            $end++;
        }

        if ($tMax > $fMax) {
            $fMax = $tMax;
            $fStart = $start;
            $fEnd = $end;
        }
    }

    return [$fMax, $fStart, $fEnd];
}

$a = [3, 2, -6, 4, 0];
$a = [3, 2, 6, -1, 4, 5, -1, 2];
var_dump(json_encode(solution($a)));