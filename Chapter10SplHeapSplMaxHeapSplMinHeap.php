<?php 

/*
    Standardowa biblioteka PHP dostarcza wbudowane klasy i można zastąpić to własną implementacją.
    Klasy:
    SplHeap stanwi implementacje podstawowej struktury sterty
    SplxMaxHeap reprezentuje kopiec typu max 
    SplMinHeap reprezentuje kopiec typu min
    Dużym minusem jest ,że klasy te nie są uznawane za wydanej ,jeśli korzysta się z języka PHP 7
*/

$numbers = [37,44,34,65,26,86,129,83,9];

$heap = new SplMaxHeap;

foreach($numbers as $number)
{
    $heap->insert($number);
}

while(!$heap->isEmpty())
{
    echo $heap->extract(). "\t";
}