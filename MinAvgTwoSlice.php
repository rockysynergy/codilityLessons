<?php

/**
 * wrong answer
 */
function solution($A) {
    // write your code in PHP7.0
    $start = 0;
    $aTsum = 0;

    $C = count($A);
    for ($i = 0; $i < $C-1; $i++) {
        $bTSum = $A[$i] + $A[$i+1];
        $aTsum += $bTSum;

        if ($bTSum < $aTsum) {
            $start = $i;
            $aTsum = $bTSum;
        }
    }

    return $start;
}

/**
 * passed the sample test
 */
function solutionB($A) {
    $sum[0] = $A[0];
    $C = count($A);
    $avg = [];

    for ($i = 1; $i < $C; $i++) {
        $sum[$i] = $A[$i] + $sum[$i-1];
        if ($i == 1) $avg[$i] = $sum[$i];
        if ($i > 1) $avg[$i] = $sum[$i] - $sum[$i-2];
    }

    $min = INF;
    $aC = count($avg);
    $t = 0;
    for ($i = 1; $i <= $aC; $i++) {
        if ($avg[$i] < $min) {
            $min = $avg[$i];
            $t = $i;
        }
    }
    $start = $t-1;
    
    $tAvg = $min / 2;
    $n = $t-2;
    $tMin = $min;
    for ($i = 3; ;$i++) {
        if (isset($A[$n])) {
            $aAvg = ($tMin + $A[$n]) / $i;
            if ($aAvg > $tAvg) {
                break;
            } else {
                $start = $n;
                $n--;
            }
        } else {
            break;
        }
    }

    return $start;
}

// solutionB([4, 2, 2, 5, 1, 5, 8]);


/**
 * passed the sample test
 */
function solutionC($A) {
    $sum[0] = $A[0];
    $C = count($A);
    $avg = [];

    for ($i = 1; $i < $C; $i++) {
        $sum[$i] = $A[$i] + $sum[$i-1];
        if ($i == 1) $avg[$i] = $sum[$i];
        if ($i > 1) $avg[$i] = $sum[$i] - $sum[$i-2];
    }

    $min = INF;
    $aC = count($avg);
    $t = 0;
    for ($i = 1; $i <= $aC; $i++) {
        if ($avg[$i] < $min) {
            $min = $avg[$i];
            $t = $i;
        }
        if ($avg[$i] == $min) {
            $mSum = $min;
            for ($j = $i+1; ; $j++) {
                if (!isset($A[$j])) break;
                $mSum += $A[$j];
                $mAvg = $mSum / (($j-$i) + 2);
                if ($mAvg > $min / 2) {
                    break;
                } else {
                    $t = $i;
                }
            }
        }
    }
    $start = $t-1;
    
    $tAvg = $min / 2;
    $n = $t-2;
    $tMin = $min;
    for ($i = 3; ;$i++) {
        if (isset($A[$n])) {
            $aAvg = ($tMin + $A[$n]) / $i;
            if ($aAvg > $tAvg) {
                break;
            } else {
                $start = $n;
                $n--;
            }
        } else {
            break;
        }
    }

    return $start;
}

/**
 * The working solution
 * based on the argument any slice average is less or equal to the whole list average. 
 * and any list will be divided into 2 or 3 item list
 */
function solutionD($A) {
    $min = ($A[0] + $A[1]) / 2;
    $idx = 0;

    $C = count($A);
    for ($i = 0; $i < $C - 2; $i++) {
        if (($A[$i] + $A[$i+1]) / 2 < $min) {
            $min = ($A[$i] + $A[$i+1]) / 2;
            $idx = $i;
        }

        if ((($A[$i] + $A[$i+1] + $A[$i+2]) / 3 < $min)) {
            $min = ($A[$i] + $A[$i+1] + $A[$i+2]) / 3;
            $idx = $i;
        }
    }

    if (($A[$C-2] + $A[$C-1]) / 2 < $min) {
        $idx = $C-2;
    }
    return $idx;
}

var_dump(solutionD([4, 2, 2, 5, 1, 5, 8]));