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

    Jedną z najważniejszych cech sortowania bąbelkowego jest to ,że w każdym 
    przejściu zewnętrznej pętli musi się odbyć przynajmniej jedna operacja 
    zamiany elementów. 
*/
$counter = 0;
function bubbleSort(array $arr): array {
    $len = count($arr);
    global $counter;
    for($i = 0; $i < $len; $i++){
        $swapped = FALSE; 
        for($j = 0; $j < $len  - 1; $j++){
            $counter++;
            if ($arr[$j] > $arr[$j + 1]){
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp; 
                $swapped = TRUE; 
            }
        }
         if(! $swapped) break;
    }
    return $arr;
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];
//$arr = [20, 45, 93, 97];
$sortedArray = bubbleSort($arr);
echo implode(",", $sortedArray);

echo "\n Sortowanie bąbelkowe (ulepszenie 1): " . $counter;

/*
Rozwiązanie                 | Licznik Porównań |
Zwykłe sortowanie bąbelkowe | 90               |
Ulepszenie 1                | 63               | Dodanie flagi - gdy nie dokona w pętli wewnętrznej ani jednego porównania to jest już tablica posortowana i można zakończyć działanie
*/
