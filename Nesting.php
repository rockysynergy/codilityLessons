<?php

function solution($S) {
    $len = strlen($S);
    $stack = [];

    for ($i = 0; $i < $len; $i++) {
        $c = $S[$i];
        if ($c == ')') {
            if (count($stack) == 0) {
                return 0;
            }
            array_pop($stack);
        }
        if ($c == '(') {
            array_push($stack, $c);
        }
    }

    if (count($stack) > 0) return 0;
    else return 1;
}

$a = '()';
$b = '(()())';
$c = '(';
$d = ')';
$e = '';
var_dump(solution($e));