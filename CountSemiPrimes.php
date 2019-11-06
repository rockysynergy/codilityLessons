<?php

$p = [1, 4, 16];
$q = [26, 10, 20];
var_dump(solution(26, $p, $q));

function solution($N, $P, $Q)
{
    $primes = getPrimes($N);
    $sPrimes = getSemiPrimes($N, $primes);
    var_dump($primes, $sPrimes);

    $M = count($P);
    $result = [];
    for ($i = 0; $i < $M; $i++) {
        $start = $P[$i];
        $end = $Q[$i];

        $sIndex = array_search($start++, $sPrimes);
        while($sIndex === FALSE && $start <= $end) {
            $sIndex = array_search($start++, $sPrimes);
        }    

        $eIndex = array_search($end--, $sPrimes);
        while($eIndex === FALSE && $start <= $end) {
            $eIndex = array_search($end--, $sPrimes);
        }

        if ($sIndex !== FALSE && $eIndex !== FALSE) $result[$i] = ($eIndex - $sIndex) + 1;
        else $result[$i] = 0;
    }

    return $result;
}

function getPrimes(int $N) {
    $sqrtN = floor(sqrt($N));
    $upper = floor($N / 2) + 1;
    $flags = [];

    for ($i = 0; $i <= $upper; $i++) {
        $flags[$i] = true;
    }

    for ($i = 2; $i < $sqrtN; $i++) {
        for ($j = 2; $j <= $upper; $j++) {
            if ($j != $i && $j % $i == 0 && $flags[$j] == true) $flags[$j] = false;
        }
    }

    $primes = [];
    for ($i = 2; $i <= $upper; $i++) {
        if ($flags[$i]) array_push($primes, $i);
    }

    return $primes;
}

function getSemiPrimes(int $N, array $primes) {
    $L = count($primes);

    $sPrimes = [];
    for ($i = 0; $i < $L; $i++) {
        for ($j = $i; $j < $L; $j++) {
            $t = $primes[$i] * $primes[$j];
            if ($t > $N) break;
            array_push($sPrimes, $t);
        }
    }
    sort($sPrimes);

    return $sPrimes;
}