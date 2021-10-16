<?php 

/*
    SELECTION SORT 

    Sortowanie przez wybieranie to kolejny algorytm sortowania wykorzystujący 
    operację porównania. Największa różnica pomiędzy tym algorytmemt a sortowaniem
    bąbelkowym polega na tym ,że sortowanie przez wybieranie wymaga mniej operacji
    zamiany elementów niż sortowanie bąbelkowe. 
    
    W sortowaniu przez wybieranie odszukuje się najmniejszy lub największy 
    element tablicy i umieszcza się go na jej początku. Jeśli porządkujemy
    tablicę rosnąco, wybieramy wartość najmniejszą. Przy sortowaniu malejącym
    wybieramy największy element. W drugiej iteracji poszukujemy drugiego najmniejszego 
    lub największego elementu tablicy i umieszczamy go na drugim miejscu. Działanie te
    powtarzamy aż do czasu, gdy element trafi w odpowiednie miejsce. 
*/

function selectionSort(array $arr): array {
    $len = count($arr);
    for($i = 0; $i < $len; $i++) {
        $min = $i; 
        for($j = $i + 1; $j < $len; $j++) {
            if($arr[$j] < $arr[$min]){
                $min = $j; 
            }
        }

        if($min != $i) {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$min];
            $arr[$min] = $tmp; 
        }
    }
    return $arr;
}


$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];
$sortedArray = selectionSort($arr);
echo implode(",", $sortedArray);

//https://www.youtube.com/watch?v=GUhWeJyHBCU