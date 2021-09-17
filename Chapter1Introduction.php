<?php

/*
    Do naszej biblioteki przyszedł nowy transport książek. Jest ich tysiąc i nie są w żaden sposób uporządkowane. Twoim zadaniem jest odnaleźć poszczególne tomy
    zgodnie z listą i umieścić je na odpowiednich pułkach. 
    Celem będzie ułożyć książki w jednym rzędzie, tak aby były widoczne wydrukowane na ich grzbietach tytuły.

    Pseudo kod

    Algorytm findABook(L, book_name)
        Wejście: lista książek oraz tytuł poszukiwanej książki book_name
        Wyjście: wartość false, jeśli książka nie zostanie znaleziona lub pozycja książki, której szukamy

    if L.size = 0 return null
    found := false
    for each item in L, do
        if item = book_name, then 
            found := position of the item
    return found 

    Algorytm placeAllBooks 
        Wejście: lista zamówionych książek OL, lista otrzymanych książek L
        Wyjście: nic 
    
        for each book_name in OL, do 
            if findABook(L,book_name), then
                remove the book from the list L
                place it to the bookshelf
*/
    function findABook(Array $givenBooks,String $bookName){
        $found = false;
        foreach($givenBooks as $index=>$book){
            if($book === $bookName){
                $found = $index;
                break;
            }
        }
        return $found;
    }
    function placeAllBooks(Array $orderedBooks,Array &$givenBooks){
        foreach($orderedBooks as $bookName){
            $bookFound = findABook($givenBooks, $bookName);
            if($bookFound !== FALSE){
                //array_splice(array, start, length, array)
                array_splice($givenBooks, $bookFound, 1);
            }
        }
    }
    $givenBooks = ['Czlowiek w poszukiwaniu sensu zycia', 'Algorytmy i Struktury Danych', 'Rusz glowa - wzorce projektowe', 'Make people like you in 90 seconds'];
    $orderedBooks = ['Algorytmy i Struktury Danych', 'Rusz glowa - wzorce projektowe'];

    placeAllBooks($orderedBooks, $givenBooks);
    echo implode(",", $givenBooks);

    /*
    ANALIZA ALGORYTMU
    Wydajność algorytmu mierzymy zwykle, odnosząc ilość danych wejściowych do liczby koniecznych kroków(złożoność czasowa) lub ilości niezbędnej pamięci(złożoność pamięciowa).
    I etap: analiza teorytyczna - dokonywana przed implementacją - zakładamy, że czynniki tj. moc obliczeniowa czy dostępna pamięć są niezmienne. 
    II etap: analiza empiryczna - analiza dokonywana po implementacji - wyniki mogą się różnić w zależności od stosowanej platformy i języka programowania.
    Otrzymujemy konkretne statystyki dotyczące wykorzystania czasu i pamięci danego systemu. 

    Złożoność czasowa - jest mierzona liczbą kluczowych operacji w algorytmie. Złożoność czasowa określa ilość czasu, jaki upływa od momemtu rozpoczęcia działania algorytmu 
    do jego zakończenia.
    Złożoność pamięciowa - definiuje ilość miejsca (w pamięci) wymaganego przez algorytm w jego cyklu życia. Jest zależna od zastosowanych struktur danych i platform. 

    Analiza asymptotyczna - jest ona związana z danymi wejściowymi , co oznacza, że gdy ich nie ma , pozostałe czynniki są stałe. Z analizy asymptotycznej korzystamy w celu
    znalezienia scenariusza najlepszego, najgorszego oraz przeciętnego przypadku algorytmu. 
        Najlepszy przypadek - wskazuje minimalny czas niezbędny do wykonania programu. Dla naszego przykładowego algorytmu najlepszym przypadkiem byłaby sytuacja w której
                              każdą książkę znajdujemy na samym początku listy.  W wyniku tego na wyszukiwanie poświęcilibyśmy bardzo mało czasu. Do oznaczania najlepszego
                              przypadku korzysta się z notacji omegi.
        Przeciętny przypadek - wskazuje średni czas potrzebny do wykonania programu. Dla naszego przykładowego algorytmu przeciętnym przypadkiem byłaby sytuacja, w której 
                               książki znajdujemy przeważnie w okolicach środka listy, lub też taka, w której połowę z nich znajdujemy na początku, a pozostałą połowę na 
                               końcu listy. Przypadek ten oznacza się thetą.
        Najgorszy przypadek - wskazuje maksymalny czas działania programu. Dla naszego przykładowego algorytmu najgorszym przypadkiem była by sytuacja, w której książki 
                              znajdujemy zawsze na samym końcu listy. Do opisu najgorszego przypadku stosujemy notację O (dużego o). Wyszukiwanie każdej książki może 
                              w przypadku algorytmu zająć O(n) czasu. Do określenia złożoności algorytmów będzie wykorzystywany ten zapis. 

    ANALIZA ALGORYTMU WYSZUKIWANIA KSIĄŻEK WŚRÓD KUPIONYCH POZYCJI I UMIESZCZANIA TOMÓW W ODPOWIEDNICH MIEJSCACH
    
    Nasz algorytm wyszukiwania książek i odpowiedniego ich rozmieszczenia operuje na n elementach. Wyszukiwanie pierwszej książki w najgorszym przypadku wiąże się z 
    koniecznością porównania jej z n pozycjami. Jeśli złożoność czasową oznaczymy jako T, 
    wówczas dla pierwszej książki będzie ona wynosiła: 
    T(1) = n
    Jako że znaleziona książka usuwana jest z listy, rozmiar listy wynosi po tej operacji n - 1. W przypadku wyszukiwania drugiej książki w najgorszym przypadku trzeba więc 
    będzie ją porównać z n - 1 książkami, dlatego złożoność czasowa dla wyszukiwania drugiej książki będzie wynosiła n - 1. Łączna złożoność czasowa dla dwóch pierwszych
    książek będzie wynosiła: 
    T(2) = n + (n - 1)
    Kontynuując ten tok rozumowania, dojdziemy do wniosku ,że po n - 1 kroków zostanie do wyszukiwania już tylko, jedna, ostatnia książka, którą będzie trzeba porównać z 1
    pozostałą książką. W związku z tym całkowita złożność będzie wygladać następująco:
    T(n) = n + (n - 1) + (n - 2) + ..... + 3 + 2 + 1
    Szerek ten nosi nazwę sumy n początkowych liczb naturalnych.  
    Po wyprowadzeniu możemy dojść do tego wzoru:
    T(n) = (n*(n+1))/2 lub T(n) = n^2/2 + n/2 

    W przypadku analizy asymptotycznej ignorujemy składniki niższego rzędu i stałe mnożniki. Ponieważ występuje tu składnik n^2, możemy swobodnie pominąć składnik n. Można
    również zignorować stały mnożnik 1/2. W związku z tym złożoność czasowoą możemy wyrazić za pomocą notacji dużego O jako rząd n do kwadratu:
    T(n) = O(n^2)
    */