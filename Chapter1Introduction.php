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

    