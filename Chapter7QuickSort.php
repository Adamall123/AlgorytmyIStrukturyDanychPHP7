<?php 

/*
    QUICK SORT 

    1. Wybierz z tablicy losową wartość, która nazywa się osią lub elementem rozdzielającym (pivot)
    2. Zmień kolejność elementów tablicy w taki sposób, aby wartości mniejsze niż oś znalazły się
    na lewo od niej, a wartości większe lub równe jej znalazły się na prawo od osi. Działanie to jest
    znane jako podział lub patrycjonowanie. 
    3. Rekurencyjnie wykonaj kroki 1. i 2. aby uporządkować powstałe podtablice (znajdujące się 
    na prawo i na lewo od osi) aż do momentu, w którym wszystkie elementy są posortowane. 

    
*/

function quickSort(array &$arr, int $p, int $r){
    if ($p < $r) {
        echo "quick sort . $p . p < r: " . $r . "\n";
        $q = partition($arr, $p, $r);
        quickSort($arr, $p,$q);
        quickSort($arr, $q + 1,$r); 
    }
}

function partition(array &$arr, int $p, int $r) {
    $pivot = $arr[$p];
    echo $pivot . " p\n";
    $i = $p - 1; 
    $j = $r + 1; 
    while(true){
        do {
            $i++;
        }while($arr[$i] < $pivot && $arr[$i] != $pivot);
        do {
            $j--;
        }while($arr[$j] > $pivot && $arr[$j] != $pivot);
    
        if ($i < $j) {
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp; 
        } else {
            echo "return " . $j . " p: " . $p . "\n"; 
            return $j; 
        }
    }
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];
quickSort($arr, 0, count($arr) - 1);
echo implode(",", $arr);