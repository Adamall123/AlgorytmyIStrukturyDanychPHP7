<?php 

/*
    Tablica w PHP jest w rzeczywistości uporządkowaną mapą. Mapa to typ, w którym wartości są powiązane z kluczami. Typ ten jest zoptymalizowany pod kątem kilku różnych zastosowań;
    może być traktowany jako tablica, lista(wektor), tablica mieszająca(implementacja mapy), słownik, kolekcja, stos, kolejka i prawdopodobnie również jako inne struktury danych. 
    Wartościami tablicy mogą być inne tablice; możliwe jest też tworzenie drzew i tablic wielowymiarowych. 
    Podział tablic:
    1) tablica liczbowa - jej indeksami są wyłącznie liczby - dane przechowywane są w sposób liniowy. 
    Przez tablicę przechodzi się w taki sposób, w jaki wprowadzane były dane. Nie istnieje żaden wewnętrzny mechanizm sortowania indeksów, choć mają one charakter liczbowy.
    Przykładowo:
   */
    $array = [10,20,30,40,50];
    $array[] = 70;
    $array[] = 80;

    $arraySize = count($array);
    for($i = 0; $i < $arraySize; $i++){
        echo "Pozycja " . $i . " przechowuje wartość: " . $array[$i] . "\n";
    }
    //Przykład drugi
    $array = [];
    $array[10] = 100;
    $array[21] = 200;
    $array[29] = 300;
    $array[500] = 1000;
    $array[1001] = 10000;
    $array[71] = 1971;

    foreach($array as $index => $value){
        echo "Pozycja " . $index . " przechowuje wartość: " . $value . "\n";
    }
   /* 
    Wyniki Przykładu drugiego pokazują ,że rozmiar naszej tablicy $array wynosi zaledwie 6. Nie ma ona wielkości 1002, jak byłoby to oczywiste w C++, Javie, w których trzeba 
    predefiniować rozmiar tablicy, zanim będzie można z niej skorzystać, zaś największym indeksem jest n-1, gdy rozmiar tablicy wynosi n. 
    2) tablica asocjacyjna
    Dostęp do Elementów tablicy asocjacyjnej realizuje się za pomocą klucza, którym może być dowolny łańcuch znakowy. W takiej tablicy wartości są wskazywane przez klucze,
    a nie przez liniowe indeksy. 
    */
    $programmersInfo = [];
    $programmersInfo['Nazwisko'] = "Wojdylo";
    $programmersInfo['Wiek'] = 27;
    $programmersInfo['Kontakt'] = 'adam.wojdylo.programista@gmail.com';

    foreach ($programmersInfo as $key=>$value){
        echo $key.": ".$value."\n";
    }
    /*
    3) tablica wielowymiarowa    
    */
    $players = [];
    $players[] = ["Nazwisko" => "Ronaldo", "Wiek" => 36, "Kraj" => "Portugalia", "Druzyna" => "Manchester United"];
    $players[] = ["Nazwisko" => "Messi", "Wiek" => 32, "Kraj" => "Argentyna", "Druzyna" => "PSG"];
    $players[] = ["Nazwisko" => "Neymar", "Wiek" => 29, "Kraj" => "Brazylia", "Druzyna" => "PSG"];

    foreach($players as $number=>$playerInfo){
        echo "Player with number: " . ($number + 1) . "\n";
        foreach($playerInfo as $key=>$value){
            echo $key . ": " . $value . "\n";
        } 
        echo "\n";
    }
    /*
    ! W językach PHP w ramach jednej tablicy można łączyć tablice liczbowe i asocjacyjne. W takim przypadku trzeba jednak zachować dużą ostrożność przy wyborze właściwego sposobu
    iteracji elementów tego rodzaju tablicy. W takich sytuacjach pętla foreach okaże się zwykle lepszym wyborem niż pętle for oraz while. 
*/


/*
UŻYWANIE TABLIC JAKO ELASTYCZNEGO SPOSOBU PRZECHOWYWANIA DANYCH

Język PHP umożliwa nie tylko tworzenie dynamicznych tablic, lecz również zapewnia szereg wbudowanych funkcji odpowiedzialnych za przeprowadzenie rozmaitych działań na tablicach. 
Przykładami mogą tu być m.in. funkcje:
array_intersect, array_merge, array_diff, array_push, array_pop, prev, next, current czy end. 

*/