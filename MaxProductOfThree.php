<?php

/**
 * The answer
 */
function solution($A) {
    // write your code in PHP7.0
    $len = count($A);
    qSort($A, 0, $len - 1);

    // For corner case: 2 negtive numbers times largest positive number get the right answer
    // [-5, 5, -5, 4] or [-5, -6, -4, -7, -10]
    $reA = $A[$len - 2] * $A[$len - 3];
    $reB = $A[0] * $A[1];
    $reC = $reB > $reA && $A[$len-1] > 0 ? $reB : $reA;
    
    return $reC * $A[$len - 1];
}

function qSort(&$A, $lo, $hi)
{
    if ($hi <= $lo) return;
    $j = partition($A, $lo, $hi);
    qSort($A, $lo, $j-1);
    qSort($A, $j+1, $hi);
}

function partition(&$A, $lo, $hi) 
{
    $i = $lo;
    $j =$hi+1;
    $v = $A[$lo];

    while (true) {
        while ($A[++$i] < $v) {
            if ($i == $hi) break;
        }

        while ($v < $A[--$j]) {
            if ($j == $lo) break;
        }

        if ($i >= $j) break;
        $c = $A[$i];
        $A[$i] = $A[$j];
        $A[$j] = $c;
    }

    $c = $A[$lo];
    $A[$lo] = $A[$j];
    $A[$j] = $c;

    return $j;
}

// var_dump(solution([-5, 5, -5, 4]));
// var_dump(solution([-5, -6, -4, -7, -10]));