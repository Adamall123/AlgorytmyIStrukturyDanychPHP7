<?php 

/*
    INSERTION SORT 

    Jeśli liczba elementów jest niewielka, sortowanie przez wstawianie sprawdza się
    lepiej niż sortowanie bąbelkowe oraz sortowanie przez wybieranie. Jeśli porządkowany
    zbiór danych jest duży, wówczas staje się ono niewydajne, podobnie jak sortowanie
    bąbelkowe. Jako że liczba operacji zmamiany elementów w sortowaniu przez wstawianie 
    rośnie niemal liniowo ,zaleca się stosować ten algorytm zamiast sortowania bąbelkowego
    oraz sortowania przez wybieranie. 

    Polega na wstawianiu liczb w odpowiednie miejsca znajdujące się na lewo od miejsc obecnie
    zajmowanych przez te liczby. Działanie zaczynamy od drugiego elementu tablicy; sprawdzamy,
    czy element znajdujacy sie na lewo jest od niego mniejszy , czy nie. Jeśli jest, przesuwamy
    obiekt znajdujący się na lewo w prawą stronę, a mniejszą wartość umieszczamy na pozycji
    pierwszej. Następnie przechodzimy do następnego elementu i porównujemy go z elementami
    po jego lewej stronie, aby odpowiednio je przesunąć i przemieścić badany element, jeśli
    jest to konieczne. Te czynności powtarzamy dla wszystkich następnych elementów tablicy aż
    do momentu, gdy zostanie ona uporządkowania. 
*/

function insertionSort(array &$arr) {
    $len = count($arr);
    for($i = 1; $i < $len; $i++){
        $key = $arr[$i];
        $j = $i - 1; 
        while($j >= 0 && $arr[$j] > $key) {
            $arr[$j+1] = $arr[$j];
            $j--;
        }
        $arr[$j+1] = $key;
    }
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];
insertionSort($arr);
echo implode(",", $arr);

//https://www.youtube.com/watch?v=8RkE7MbqVl8
