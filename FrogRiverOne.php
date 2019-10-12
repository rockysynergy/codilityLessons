<?php

function solution($X, $A) {
    // write your code in PHP7.0
    $count = [];

    foreach ($A as $k=>$v) {
        if ($v <= $X) {
            $count[$v] = 1;
            if (count($count) == $X) return $k;
        }
    }

    return -1;
}
