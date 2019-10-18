<?php

function solution($S) {
    // write your code in PHP7.0
    $len = strlen($S);
    $St = [];
    $closes = [']', '}', ')'];
    $opens = [
        ']' => '[',
        ')' => '(',
        '}' => '{',
    ];

    for ($i = 0; $i < $len; $i++) {
        $c = $S[$i];
        if (in_array($c, $closes)) {
            $pop = array_pop($St);
            if (strlen($pop) == 0 || $pop != $opens[$c]) return 0;
        } else {
            array_push($St, $c);
        }
    }

    return count($St) == 0 ? 1 : 0;
}

var_dump(solution("{[()()]}"));