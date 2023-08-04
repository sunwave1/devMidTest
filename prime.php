<?php

/**
 * Create a function of calculate prime - Fellipe Anthony 01/08/23
 */

$fn = function(int $n){
    if ($n <= 1) { return false; }
    for ($index = 2; $index <= sqrt($n); $index++) {
        if ($n % $index == 0) {
            return "Not Prime";
        }
    }
    return "Is Prime";
};

foreach(range(1, 10) as $n){
  echo "$n: " . $fn( $n ) . PHP_EOL;
}