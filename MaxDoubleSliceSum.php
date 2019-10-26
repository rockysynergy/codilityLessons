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
    if ($L <= 3) return 0;
    for ($i = 1; $i < $L; $i++) {
        if ($tMax <= 0) {
            $tMax = $A[$i];
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

    if ($fEnd - $fStart < 3 || $fMax < 0) {
        $tRe = [$fStart, -100, $fEnd];
        $tMax = $fMax > 0 ? $fMax : 0;
        array_push($tRe, $tMax);
        return $tRe;
    }

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

    $sum = 0;
    for ($j = $tStart+1; $j < $tEnd; $j++) {
        if ($j != $tMiddle) {
            $sum += $A[$j];
        }
    }

    return [$tStart, $tMiddle, $tEnd, $sum];
    return $sum;
}

$a[] = [[3, 2, -6, 4, 0], 6];
$a[] = [[3, 2, 6, -1, 4, 5, -1, 2], 17];
$a[] = [[5, 17, 0, 3], 17];
$a[] = [[0, 10, -5, -2, 0], 10];
$a[] = [[5, 5, 5], 0];
$a[] = [[-8, 10, 20, -5, -7, -4], 30];
$a[] = [[-4, -5, -1, -5, -7, -19, -11], 0];

// foreach ($a as $t) {
//     $re = solution($t[0]);
//     if (($re[3] == $t[1]) && !(count($t[0]) < 4 && $re != 0)) {
//     } else {
//         var_dump('Wrong: ' . json_encode($re) . ' for: ' . json_encode($t));
//     }
// }
// var_dump(json_encode(solution($a)));


/**
 * The idea is: 
 *  1. find the max first
 *  2. try to extend 
 *  3. try to shrink
 *  4. determine which to use
 */
function solutionB($A) {
    $tMax = count($A) > 0 ? $A[0] : 0;
    $fMax = $tMax;

    $fStart = 0;
    $fEnd = 0;
    $start = 0;
    $end = 0;

    // Find the max subslice
    $L = count($A);
    if ($L <= 3) return 0;
    for ($i = 1; $i < $L; $i++) {
        if ($tMax <= 0) {
            $tMax = $A[$i];
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

    // Find the temporary middle
    $tMiddle = $A[$fStart];
    for ($i = $fStart; $i <= $fEnd; $i++) {
        if ($A[$i] < $tMiddle) $tMiddle = $A[$i];
    }

    $rExtEnd = $fEnd;
    $rExtSum = $A[$fEnd];
    $rMin = 0;
    $lExtEnd = $fStart;
    $lExtSum = $A[$fStart];

    $rShrinkEnd = $fEnd;
    $rShrinkSum = $A[$fEnd-1];
    $lShrinkEnd = $fStart;
    $lShrinkSum = $A[$fStart+1];
    $lMin = 0;
    // Right Extend
    if ($fEnd < $L) {
        $skipedMin = false;
        for ($i = $fEnd+1; $i < $L; $i++) {
            if ($A[$i] < $rMin && !$skipedMin) {
                $rMin = $A[$i];
                $skipedMin = true;
            } else {
                $rExtSum += $A[$i];
                if ($rExtSum < $A[$fEnd]) {
                    $rExtEnd = $i;
                    $rExtSum -= $A[$i];
                    break;
                }
            }
        }
    }

    // Left Extend
    if ($fStart > 0) {
        for ($i = $fStart - 1; $i >= 0; $i--) {
            $skipedMin = false;
            if ($A[$i] < $lMin && !$skipedMin) {
                $lMin = $A[$i];
                $skipedMin = true;
            } else {
                $lExtSum += $A[$i];
                if ($lExtSum < $A[$fStart]) {
                    $lExtEnd = $i;
                    $lExtSum -= $A[$i];
                    break;
                }
            }
        }
    }

    // Determine to use which extend
    $fExtSum = 0;
    if ($rExtSum - $A[$fEnd] > $A[$fEnd] && $lExtSum - $A[$fStart] > $A[$fStart]) {
        // Extend both
        $aMiddle = $lMin < $rMin ? $lMin: $rMin;
        $tMiddle = $tMiddle < $aMiddle ? $aMiddle : $tMiddle;
        $fExtSum = $fMax + $rExtSum + $lExtSum - $A[$fStart] - $A[$fEnd] + $tMiddle;
    } else if ($rExtSum - $A[$fEnd] > $A[$fEnd]) {
        $tMiddle = $tMiddle < $rMin ? $tMiddle : 0;
        $fExtSum = $fMax + $rExtSum - $A[$fEnd];
    } else if ($lExtSum - $A[$fStart] > $A[$fStart]) {
        $fExtSum = $fMax + $lExtSum - $A[$fStart];
    }

    // Shrink from right
    for ($i = $fEnd - 1; $i - $fStart > 3; $A[$fEnd - 1] < 0) {

    }

    // Shrink from left
    if ($A[$fStart + 1] < 0) {

    }

    // determine to use which shrink

}

function solutionC($A) {
    $L = count($A);
    $k1 = [];
    $k2 = [];
    $k1[0] = 0;
    $k2[$L-1] = 0;

    for ($i = 1; $i < $L - 1; $i++) {
        $sum = $k1[$i-1] + $A[$i];
        $k1[$i] = $sum < 0 ? 0 : $sum;
    }

    for ($i = $L - 2; $i > 0; $i--) {
        $sum = $k2[$i+1] + $A[$i];
        $k2[$i] = $sum < 0 ? 0 : $sum;
    }

    $max = 0;
    for ($i = 1; $i < $L - 1; $i++) {
        $max = max($max, $k1[$i-1]+$k2[$i+1]);
    }
    return $max;
}

var_dump(solutionC([-1, -2, -4, -8, -19]));