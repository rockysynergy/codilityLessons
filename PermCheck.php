<?php

function solution($A) {
    // write your code in PHP7.0
    $m = count($A);
    $cout = [];
    for ($i = 0; $i <= $m; $i++) {
        $cout[$i] = 0;
    }

    foreach ($A as $a) {
        $cout[$a] += 1;
    }

    for ($i = 1; $i <= $m; $i++) {
        if ($cout[$i] !== 1) {
            return 0;
        }
    }

    return 1;
}
