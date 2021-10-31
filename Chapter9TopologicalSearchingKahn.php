<?php 

/*
    Algorytm Kahna wykorzystuje następujące kroki, aby odnaleźć topologiczny porządek
    struktury DAG:
    1. Oblicz stopień wchodzący(liczbę wchodzących krawędzi do wierzchołka) dla każdego
    wierzchołka i umieść w kolejce wszystkie wierzchołki, których stopień wchodzący 
    wynosi 0. 
    2. Usuń wierzchołek z kolejki i wykonaj na nim poniższe operacje:
    a) Zwiększ o 1 liczbę odwiedzonych węzłów
    b) Zmniejsz o 1 stopień wchodzący wszystkich sąsiadujących wierzchołków
    c) Jeśli stopień wchodzący któregoś wierzchołka sąsiadującego stanie się
    równy 0, dodaj ten wierzchołek do kolejki.
    3. Powtarzaj krok 2, aż do chwili, gdy kolejka stanie się pusta. 
    4. Jeśli liczba odwiedzonych węzłów nie jest równa liczbie wszystkich 
    węzłów, to topologiczne sortowane danej struktury DAG nie jestm możliwe. 
    DAG - skierowany graf acykliczny
*/

$graph = [
  [0,0,0,0,1],
  [1,0,0,1,0],
  [0,1,0,1,0],
  [0,0,0,0,0],
  [0,0,0,0,0] , 
];

function topologicalSort(array $matrix): SplQueue{
    $order = new SplQueue;
    $queue = new SplQueue;
    $size = count($matrix);
    $incoming = array_fill(0, $size, 0);

    for($i = 0; $i < $size; $i++){
        for($j = 0; $j < $size; $j++){
            if($matrix[$j][$i]){
                $incoming[$i] ++;
            }
        }
        if ($incoming[$i] == 0){
            $queue->enqueue($i); 
        }
    }

    While(!$queue->isEmpty()){
        $node = $queue->dequeue();

        for($i = 0; $i < $size; $i++){
            if ($matrix[$node][$i] == 1) {
                $matrix[$node][$i] = 0; 
                $incoming[$i] --;
                if ($incoming[$i] == 0){
                    $queue->enqueue($i);
                }
            }
        }
        $order->enqueue($node);
    }

    if ($order->count() != $size)
        return new SplQueue;

    return $order; 
}

$sorted = topologicalSort($graph);

while(!$sorted->isEmpty()){
    echo $sorted->dequeue() . "\t";
}