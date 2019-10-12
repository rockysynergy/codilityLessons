<?php

/**
 * Partially work.
 * Too much cornercases to consider
 */
function solution($A, $B, $K) {
    // write your code in PHP7.0

    if ($A == $B)  {
        if ($A == 0) {
            return 1;
        } else {
            $c = (int) floor($A / $K);
            if ($A % $K == 0)  {
                $c--;
            }
            return $c;
        }
    }
    if ($K > $B) return 0;
    
    $rank = ($B - $A) + 1; 
    $num = floor($rank / $K);
    if ($num * $K + $A < $B) $num++;
    if ($B % $K == 0) $num++;
    return (int) $num;
}

// var_dump(solution(10, 10, 20));
// var_dump(solution(11, 345, 17));

/**
 * The working solution
 * covered cornercases 1. (0, 0, K), (10, 10, 2)
 */
function solutionB($A, $B, $K) {
    $min_val = floor(($A + $K - 1) / $K) * $K;

    if ($min_val > $B) return 0;
    $re = floor(($B - $min_val) / $K) + 1;
    return (int) $re;
}


// The algorithm is correct but failed performance testing as expected
function solutionC($A, $B, $K) {
    if ($A == $B && $A == 0) return 1;
    
    $first = floor(($A + $K - 1) / $K) * $K;
    if ($first > $B) return 0;
    $j = 0;
    for ($i = $first; $i <= $B; $i += $K) {
        $j++;
    }
    return $j;
}