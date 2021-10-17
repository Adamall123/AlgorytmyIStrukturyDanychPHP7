<?php 

/*
    Jedna z najbardziej rozpowszechnionych metod wyszukiwania polega na porównywaniu każdego elementu
    należącego do przeszukiwania zbioru z tym, którego szukamy. Jest to najprostszy sposób wyszukiwania. 
    Jeśli założymy, że na liście znajduje się n elementów, w najgorszym przypadku musimy je wszystkie
    przeszukać, iterując po liście lub tablicy, aby znaleźć określony element. 
*/

function search(array $numbers, int $needle): bool {
    $totalItems = count($numbers);

    for($i = 0; $i < $totalItems; $i++) {
        if($numbers[$i] === $needle) {
            return TRUE;
        }
    }
    return FALSE;
}

$numbers = range(1,200, 5);

if(search($numbers, 31)){
    echo "Znaleziono";
} else {
    echo "Nieznaleziona";
}

/*
    Warto zauważyć ,że nie musimy się przejmować czy lista jest uporządkowana, jeśli szukany element
    poja sięna pierwszej pozycji, mamy do czynienia z najlepszym przypadkiem, a z najgorszym gdy
    szukany element znajduje się na ostatnim miejscu w liście lub w ogóle. 
*/