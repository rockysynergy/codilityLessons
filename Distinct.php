<?php

function solution($A) {
    $len = count($A);

    $c = 0;
    $ca = [];
    for ($i = 0; $i < $len; $i++) {
        if (!isset($ca[$A[$i]])) {
            $ca[$A[$i]] = true;
            $c++;
        }
    }

    return $c;
}