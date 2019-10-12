<?php

function solution($A) {
    // write your code in PHP7.0
    $idxes = [];
    $C = [];
    $L = count($A);
    $mid = floor($L/2);

    foreach ($A as $k=>$v) {
        if (!isset($C[$v])) {
            $idxes[$v] = [];
            $C[$v] = 0;
        }

        $C[$v] += 1;
        array_push($idxes[$v], $k);

        if ($C[$v] > $mid) {
            $rIdx = $v;
        }
    }

    if (isset($rIdx)) {
        return $idxes[$rIdx][0];
    }
    return -1;
}

var_dump(solution([3, 4, 3, 2, 3, -1, 3, 3]));