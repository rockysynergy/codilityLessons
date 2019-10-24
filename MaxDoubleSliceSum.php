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
    // return [$fMax, $fStart, $fEnd];

    if ($fEnd - $fStart < 4) return 0;

    $tStart = $fStart;
    $tEnd = $fEnd;
    $nEnd = $A[$tEnd-1];
    while ($tEnd - $tStart >= 3 && $nEnd < 0) {
        $tEnd--;
        $nEnd = $A[$tEnd - 1];
    }

    $nStart = $A[$tStart];
    $tnStart = $A[$tStart + 1];
    while ($tEnd - $tStart >= 3 && $tnStart < 0 && $tnStart < $nStart) {
        $tStart++;
        $nStart = $tnStart;
        $tnStart = $A[$tStart + 1];
    }

      
    $tMiddle = $tStart + 1;
    $tMin = $A[$tMiddle];
    for ($i = $tMiddle; $i < $tEnd; $i++) {
        if ($A[$i] < $tMin) {
            $tMiddle = $i;
            $tMin = $A[$i];
        }
    }

    return [$tStart, $tMiddle, $tEnd];
}

$a = [3, 2, -6, 4, 0];
$a = [3, 2, 6, -1, 4, 5, -1, 2];
var_dump(json_encode(solution($a)));