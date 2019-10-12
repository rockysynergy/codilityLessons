<?php
/**
 * Correct but slow solution
 */
function solutionA($N, $A) {
    // write your code in PHP7.0
    $max = 0;
    for ($i = 1; $i <= $N; $i++) {
        $counters[$i] = 0;
    }

    foreach ($A as $op) {
        if ($op <= $N) {
            $counters[$op] += 1;
            if ($counters[$op] > $max) {
                $max = $counters[$op];
            }
        }

        if ($op > $N) {
            foreach ($counters as $k => $v) {
                $counters[$k] = $max;
            }
        }
    }

    return array_values($counters);
}

/**
 * Wrong solution
 */
function solutionB($N, $A) {
    // write your code in PHP7.0
    $max = 0;
    for ($i = 1; $i <= $N; $i++) {
        $counters[$i] = 0;
    }

    $added = [];
    foreach ($A as $op) {
        if ($op <= $N) {
            array_push($added, $op);
            $counters[$op] += 1;
            if ($counters[$op] + $max > $max) {
                $max += $counters[$op];
            }
        }

        if ($op > $N) {
            foreach ($added as $z) {
                $counters[$z] = 0;
            }
            $added = [];
        }
    }

    $re = [];
    for($i = 1; $i <= $N; $i++) {
        $re[] = $counters[$i] + $max;
    }
    return $re;
}

/**
 * Correct solution with redundant code
 */
function solutionC($N, $A) {
    // write your code in PHP7.0
    $max = 0;
    $tMax = 0;
    $counters = [];
    $cleared = false;

    foreach ($A as $op) {
        if ($op <= $N) {
            if (!isset($counters[$op])) $counters[$op] = 0;
            $counters[$op] += 1;
            if ($counters[$op] > $tMax) {
                $tMax = $counters[$op];
            }
        }

        if ($op > $N) {
            $counters = [];
            $cleared = true;
            $max += $tMax;
            $tMax = 0;
        }
    }

    $re = [];
    for ($i = 1; $i <= $N; $i++) {
        if ($cleared) {
            if (isset($counters[$i])) {
                $re[$i-1] = $max + $counters[$i];
            } else {
                $re[$i-1] = $max;
            }
        } else {
            if (isset($counters[$i])) {
                $re[$i-1] = $counters[$i];
            } else {
                $re[$i-1] = 0;
            }
        }
    }
    return $re;
}

/**
 * Correct and final solution
 */
function solutionD($N, $A) {
    // write your code in PHP7.0
    $max = 0;
    $tMax = 0;
    $counters = [];

    foreach ($A as $op) {
        if ($op <= $N) {
            if (!isset($counters[$op])) $counters[$op] = 0;
            $counters[$op] += 1;
            if ($counters[$op] > $tMax) {
                $tMax = $counters[$op];
            }
        }

        if ($op > $N) {
            $counters = [];
            $max += $tMax;
            $tMax = 0;
        }
    }

    $re = [];
    for ($i = 1; $i <= $N; $i++) {
        if (isset($counters[$i])) {
            $re[$i-1] = $max + $counters[$i];
        } else {
            $re[$i-1] = $max;
        }
    }
    return $re;
}