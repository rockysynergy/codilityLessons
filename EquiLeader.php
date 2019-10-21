<?php

// The solution got 66% only
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

    // No leader
    if (!isset($rIdx)) {
        return 0;
    }
    
    $leaderIndexes = $idxes[$rIdx];
    // print_r($leaderIndexes);
    $leaderTotal = count($leaderIndexes);
    $eCount = 0;
    for ($i = 0; $i < $leaderTotal; $i++) {
        $leaderIndex = $leaderIndexes[$i];
        $taCount = $leaderIndex + 1;
        
        $taMid = floor($taCount / 2);
        // $i + 1 is the count of leaders so far
        if ($i+1 > $taMid){
            $tbCount = $L - $taCount;
            $leftLeaders = $leaderTotal - ($i + 1); 
            // print "\$i: $i, \$leaderIndex: $leaderIndex, \$taCount: $taCount, \$tbCount: $tbCount, \$leftLeaders: $leftLeaders \r\n";
            if ($leftLeaders > floor($tbCount / 2)) {
                $eCount++;
            }

            // borrow from left for list like [4, 4, 2, 5, 3, 4, 4, 4];
            if ($i + 1 > floor(($taCount + 1) / 2) && $i+1 < $leaderTotal && $leaderIndexes[$i+1] != $leaderIndexes[$i] + 1 && $leftLeaders > floor(($tbCount - 1) / 2)) {
                $eCount++;
            }
        } 
    }

    return $eCount;
}

$a = [4, 3, 4, 4, 4, 2];
$a = [4];
$a = [4, 4];
$a = [1, 2, 3];
$a = [4, 4, 2, 5, 3, 4, 4, 4];
var_dump(solution($a));