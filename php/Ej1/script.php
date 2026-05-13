<?php

function esPrimo($n) {
    if ($n < 2) return false;
    
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    
    return true;
}


$primos = [];
$pares = [];
$impares = [];

for ($i=0; $i <= 1000 ; $i++) { 
    if($i % 2 == 0 ){
        array_push($pares, $i);
    }else{
        array_push($impares, $i);
    }
    if(esPrimo($i)){
        array_push($primos, $i);
    };
}
?>