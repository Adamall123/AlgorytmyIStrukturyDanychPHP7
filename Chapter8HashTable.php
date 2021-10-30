<?php 

$arr = []; 
$count = rand(10,30); 

for($i = 0; $i < $count; $i++)
{
    $val = rand(1,500);
    $arr[$val] = $val;
}

$number = 100; 
if(isset($arr[$number])) {
    echo "$number znalezione";
}else {
    echo "$number nieznalezione";
}

//wbudowana funkcja php hash
// string hash(string $algo, string $data [,bool $raw_output = false ])

/*
    Pierwszym parametrem tej funkcji jest typ algorytmu, z którego chcemy skorzystać do mieszania. 
    Do wyboru takie algorytmy jak:
    - md5
    - shal 
    - sha256 
    - crc32 
    - in 
    Każdy z nich generuje skrót o stałej długości, który można wykorzystać jako klucz naszej tablicy mieszającej 
    Odczytywanie szukanej wartości sprowadza się do bezpośredniego odczytania wartości spod określonego indeksu , 
    dzięki temu złożoność wynosi O(1)
*/