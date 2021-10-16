<?php

/*
SORTOWANIE BĄBELKOWE

    Jest to algorytm wykorzystujący porównywanie elementów, któ jest zawsze 
    wskazywany jako jeden z najmniej wydajnych sposobów porządkowania
    kolekcji. Wymaga on przeprowadzenia maksymalnej liczby porównań, a 
    jego złożoności w przeciętnym i najgorszym przypadku są takie same. 

    W sortowaniu bąbelkowym każdy element listy jest porównywany z jej 
    pozostałymi elementami, jeśli jest to konieczne. Operacje te 
    przeprowadzane są dla każdego elementu listy. W ten sposób można
    sortować rosnąco lub malejąco. 

*/

function bubbleSort(array $arr): array {
    $len = count($arr);

    for($i = 0; $i < $len; $i++){
        for($j = 0; $j < $len - 1; $j++){
            if ($arr[$j] > $arr[$j + 1]){
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp; 
            }
        }
    }
    return $arr;
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];

$sortedArray = bubbleSort($arr);

echo implode(",", $sortedArray);