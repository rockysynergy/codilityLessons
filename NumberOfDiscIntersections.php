<?php

/**
 * https://app.codility.com/c/run/training8TDH5U-VXX/
 */
function solution($A)
{
    $starts = [];
    $ends = [];

    $centers = 0;
    foreach ($A as $k => $r) {
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

/**
 * passed! The most critical lies with line 65 and 92
 */
function solutionB($A)
{
    // make the ends
    $E = [];
    foreach ($A as $c => $r) {
        $lEnd = $c - $r;
        if (!isset($E[$lEnd])) {
            $E[$lEnd] = [0, 0];
        }
        $E[$lEnd][0] += 1;

        $rEnd = $c + $r;
        if (!isset($E[$rEnd])) {
            $E[$rEnd] = [0, 0];
        }
        $E[$rEnd][1] += 1;
    }
    ksort($E);

    $activeCircles = 0;
    $intersections = 0;
    foreach ($E as $num => $ends) {
        print "num: " . $num . " activeCircles: " . $activeCircles . ' Ends: ' . json_encode($ends). "\r\n";
        $intersections += $activeCircles * $ends[0] + CalInters::get($ends[0]);
        if ($intersections > 10000000) {
            return -1;
        }
        $activeCircles = $activeCircles + $ends[0] - $ends[1];
    }

    return $intersections;
}

class CalInters
{
    private static $ins = [
        0 => 0,
        1 => 0,
        2 => 1
    ];

    public function get($n)
    {
        // print ">>>> get: ".$n . " ==> " . json_encode(self::$ins) ."\r\n";
        if ($n < 2) return 0;
        if (isset(self::$ins[$n])) return self::$ins[$n];

        for ($i = 3; $i <= $n; $i++) {
            if (!isset(self::$ins[$i])) {
                // print "---- calc: " . $i . "\r\n";
                self::$ins[$i] = $i - 1 + self::$ins[$i-1];
            }
        }

        return self::$ins[$n];
    }
}
// var_dump(solutionB([1, 5, 2, 1, 4, 0]));

// $a = new CalInters();
// var_dump($a->get(10));
// print '<<<<<<<<<<<<<<<<<<<<<<<<';
// var_dump($a->get(15));

var_dump(CalInters::get(10));
print '<<<<<<<<<<<<<<<<<<<<<<<<';
var_dump(CalInters::get(15));
