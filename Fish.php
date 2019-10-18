<?php

function solution($A, $B) {
    // write your code in PHP7.0
    $C = count($A);
    if ($C == 0) return 0;

    $aStack = [];
    array_push($aStack, [$A[0], $B[0]]);

    for ($i = 1; $i < $C; $i++) {
        $aFish = array_pop($aStack);
        if ($aFish[1] == 1 && $B[$i] == 0) {
            // Meet only one survive
            if ($aFish[0] > $A[$i]) {
                array_push($aStack, $aFish);
            } else {
                $naFish = [$A[$i], $B[$i]];
                $tFish = $aFish;
                while (count($aStack) > 0 && $tFish[1] == 1) {
                    if ($tFish[0] < $A[$i]) {
                        $tFish = array_pop($aStack);
                    } else {
                        $naFish = $tFish;
                        break;
                    }
                }
                if ($tFish[1] == 0) array_push($aStack, $tFish);
                array_push($aStack, $naFish);
            }
        } else {
            array_push($aStack, $aFish);
            array_push($aStack, [$A[$i], $B[$i]]);
        }
    }

    return count($aStack);
}

var_dump(solution([4, 5], [1, 0]));