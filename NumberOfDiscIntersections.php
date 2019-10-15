<?php

function solution($A) {
    $starts = [];
    $ends = [];

    $centers = 0;
    foreach ($A as $k=>$r) {
        $left = $k - $r;
        $right = $k + $r;
        if ($left < 0) $left = 0;

        if (!isset($starts[$left])) $starts[$left] = 0;
        $starts[$left] += 1;
        if (!isset($ends[$right])) $ends[$right] = 0;
        $ends[$right] += 1;
        $centers++;
    }

    $S = 0;
    $L = count($starts);
    $pIn = 0;
    for ($i = 0; $i < $L; $i++) {
        $in = isset($starts[$i]) ? $starts[$i] : 0;
        $out = isset($ends[$i]) ? $ends[$i] : 0;
        $cIn = $pIn + $in - $out;
        $S += $cIn;
        $pIn = $cIn;
        if (($S - $centers) > 10000000) return -1;
    }

    return $S - $centers;
} 