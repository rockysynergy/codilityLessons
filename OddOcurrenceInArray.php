<?php

// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A) {
    // write your code in PHP7.0
    $C = [];
    
    foreach ($A as $k=>$v) {
        if (!isset($C[$v])) {
            $C[$v] = [];
        }
        
        array_push($C[$v], $k);
    }
    
    foreach ($C as $k=>$c) {
        if (count($c) % 2 == 1) {
            return $k;
            break;
        }
    }
    
}