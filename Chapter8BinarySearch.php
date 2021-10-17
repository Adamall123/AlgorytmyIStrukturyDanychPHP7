<?php 

/*
    BINARY SEARCH 

    W rpzypadku binarnego wyszukiwania zaczynamy od środka listy, sprawdzamy czy znajdujący się tam element 
    jest mniejszy czy większy od szukanego, a następnie decydujemy w którą stronę przejść. W  ten sposób 
    dzielimy listę na połowy i całkowicie pomijamy jedną z nich. 
*/

function binarySearch(array $numbers, int $needle): bool {
    $low = 0;
    $high = count($numbers) - 1; 
    while($low <= $high) {
        $mid = (int) (($low + $high) / 2);

        if($numbers[$mid] > $needle) {
            $high = $mid - 1; 
        } elseif ($numbers[$mid] < $needle) {
            $low = $mid + 1; 
        } else {
            return TRUE;
        }
    }
    return FALSE;
}

$numbers = range(1, 200, 5);

$number = 31;

if(binarySearch($numbers, $number)){
    echo "Znaleziono\n";
} else {
    echo "Nieznaleziona\n";
}

$number = 500;

if(binarySearch($numbers, $number)){
    echo "Znaleziono\n";
} else {
    echo "Nieznaleziona\n";
}