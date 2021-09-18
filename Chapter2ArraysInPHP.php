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

/* UŻYWANIE WIELOWYMIAROWYCH TABLIC DO REPREZENTOWANIA STRUKTUR DANYCH

Przykład: Odwzorowanie grafu przy użyciu tablicy wielowymiarowej - graf narysowany na stronie 45.

W tym celu trzeba skonstruować dwuwymiarową tablicę, w której kluczami są węzły, a wartościami liczby 0 lub 1 w zależności od tego, czy odpowiednie dwa węzły są ze sobą połączoe
czy też nie. 

*/
$graph = [];
$nodes = ['A', 'B', 'C', 'D', 'E'];
foreach($nodes as $xNode){
    foreach($nodes as $yNode){
        $graph[$xNode][$yNode] = 0;
    }
}
foreach($nodes as $xNode){
    foreach($nodes as $yNode){
        echo $graph[$xNode][$yNode] . "\t";
    }
    echo "\n";
}
$graph['A']['B'] = 1; 
$graph['B']['A'] = 1;
$graph['A']['C'] = 1;  
$graph['C']['A'] = 1; 
$graph['A']['E'] = 1; 
$graph['E']['A'] = 1; 
$graph['B']['E'] = 1; 
$graph['E']['B'] = 1; 
$graph['B']['D'] = 1; 
$graph['D']['B'] = 1; 

echo "\n";
echo "   A\t B\t C\t D\t E\t\n";
foreach($nodes as $xNode){
    echo $xNode . " |";
    foreach($nodes as $yNode){
       
        echo $graph[$xNode][$yNode] . "\t";
    }
    echo "\n";
}

/*
    TWORZENIE TABLIC O STAŁYM ROZMIARZE ZA POMOCĄ KLASY SplFixedArray
    
    Gdy wiemy, że potrzebujemy jedynie tablicy o określonej liczbie elemtnów, możemy użyć tablicy o ustalonej wielkości w celu ograniczenia zużycia pamięci operacyjnej. 
*/
echo "Stworzenie obiektu SplxFixedArray - rozmiar tablicy staly\n";
$array = new SplFixedArray(10);
for ($i = 0; $i < 10; $i++){
    $array[$i] = $i; 
}
for ($i = 0; $i < 10; $i++){
    echo $array[$i] . "\n";
}

/*
Podstawowe różnice między tablicą PHP a obiektem klasy SplFixedArray
    - obiekt klasy SplFixedArray musi mieć zdefiniowany stały rozmiar
    - indeksami tablicy będącej obiektem klasy SplFixedArray muszą być liczby całkowite i należące do zakresu od 0 do n, gdzie n jest rozmiarem tablicy którą zdefiniowaliśmy.

Klasa SplxFiexArray może się okazać bardzo przydatna, gdy mamy do czynienia z dużą liczbą tablic o znanych rozmiarach lub znamy górne granice rozmiarów wymaganych tablic. Jeśli
jednak nie są nam znane te rozmiary, lepiej jest użyć tablic PHP. 
*/
echo "Wydajnosc zwyklych tablic \n";
$startMemory = memory_get_usage(); //Returns the amount of memory, in bytes, that's currently being allocated to your PHP script.
$arrayPHP = range(1,100000);
$endMemory = memory_get_usage();
echo "Tablica wykorzystuje: ". ($endMemory - $startMemory) . " bajtow";
$memoryConsumed = ($endMemory - $startMemory) / (1024 * 1024);
$memoryConsumed = round($memoryConsumed);
echo "\nPamiec zwyklej tablicy(100tys. el) =  {$memoryConsumed} MB\n";
//Wyjaśnienie skąd tak dużo PHP zużywa tak dużo pamięci strona 48 

$items = 100000;
$startMemory = memory_get_usage(); //Returns the amount of memory, in bytes, that's currently being allocated to your PHP script.
$arraySpl = new SplFixedArray($items);
for($i = 0; $i < $items; $i++){
    $arraySpl[$i] = $i;
}
$endMemory = memory_get_usage();
$memoryConsumed = ($endMemory - $startMemory) / (1024 * 1024);
$memoryConsumed = ceil($memoryConsumed);
echo "Pamiec obiektu SplFixedArray(100tys. el) =  {$memoryConsumed} MB\n";

/*
    Tablica SplFixArray ma mniejszy apetyt nie tylko na pamięć , lecz również zapewnia większą szybkość przetwarzania w porównaniu do ogólnych operacji 
    na tablicach PHP, tj. uzyskiwanie dostępu do wartości, przypisywanie wartości itd. 
    Nie da się w SplFixArray używać funkcji operującej na tablicach PHP tj. array_sum, array_filter itd. 
    LINKI
    https://www.npopov.com/2011/12/12/How-big-are-PHP-arrays-really-Hint-BIG.html
*/

/*
    Z uwagi na to, że tablice SplFixedArray są znacznie wydajniejsze niż tablice PHP, powinniśmy korzystać z tych pierwszych zamiast z tych drugich w przypadku 
    w większości tworzonych algorytmów i struktur danych. 
    WIECEJ PRZYKŁADÓW ZASTOSOWANIA TABLICY SPLFIXEDARRAY
*/
    //From PHP array to SplFixedArray
    $newArray = [1 => 10, 2=> 100, 3=> 1000, 4=> 10000];  
    $splArray = SplFixedArray::fromArray($newArray, false);
    print_r($splArray);
   
//Jeśli chcemy skonwertować tablicę PHP na tablicę o stałym rozmiarze w czasie wykonania, dobym pomysłem będzie usunięcie tej pierwszej,
//jeśli nie zamierzamy jej później używać. Pozwoli nam to zaoszczędzić miejsce w pamięci, co ma szczególne znaczenie, jeśli tablica jest wielka. 

//From SplFixedArray to PHP array
    $items = 5; 
    $array = new SplFixedArray($items);
    for($i = 0; $i < $items; $i++){
        $array[$i] = $i * 10; 
    }
    $newArray = $array->toArray();
    print_r($newArray);
// Zmiana rozmiaru tablicy SplFixedArray po jej deklaracji 

$items = 5; 
$array = new SplFixedArray($items);
for($i = 0; $i < $items; $i++){
    $array[$i] = $i * 10; 
}
$array->setSize(10);
$array[7] = 100;
var_dump($array);