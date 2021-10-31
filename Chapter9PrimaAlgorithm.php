<?php 

$G = [
    [0,3,1,6,0,0],
    [3,0,5,0,3,0],
    [1,5,0,5,6,4],
    [6,0,5,0,0,2],
    [0,3,6,0,0,6],
    [0,0,4,2,6,0]
];
//mst  - minimalne drzewo rozpinające
function primMST(array $graph) {

    $parent = []; // tablica przechowująca MST
    $key = []; //tablica używana do wybierania krawędzi o najmniejszej wadze
    $visited = []; // tablica przechowująca wierzchołki, które nie zostały jeszcze włączone do MST
    $len = count($graph);

    //Inicjalizacja wszystkich kluczy za pomocą wartości MAX

    for ($i = 0; $i < $len; $i++){
        $key[$i] = PHP_INT_MAX;
        $visited[$i] = false; 
    }

    $key[0] = 0;
    $paren[0] = -1; 

    //MST będzie miało V wierzchołków 
    for($count = 0; $count < $len - 1; $count++){
        //Wybranie wierzchołka o najmniejszych kluczu 
        $minValue = PHP_INT_MAX;
        $minIndex = -1; 

        foreach (array_keys($graph) as $v) {
            IF($visited[$v] == false && $key[$v] < $minValue) {
                $minValue = $key[$v];
                $minIndex = $v; 
            }
        }
        $u = $minIndex; 

        // Dodanie wybranego wierzchołka do zbioru MST 
        $visited[$u] = true; 

        for ($v = 0; $v < $len; $v++) {
            if ($graph[$u][$v] != 0 && $visited[$v] == false && $graph[$u][$v] < $key[$v]) {
                $parent[$v] = $u;
                $key[$v] = $graph[$u][$v];
            }
        }
    }
        // Wyświetlenie MST
        echo "Krawędź\tWaga\n";
        $minimumCost = 0; 
        for($i = 1; $i < $len; $i++){
            echo $parent[$i] . " - " . $i . "\t" . $graph[$i][$parent[$i]]  . "\n";
            $minimumCost += $graph[$i][$parent[$i]];
        }
        echo "Minimalny koszt: $minimumCost \n";
}
primMST($G);