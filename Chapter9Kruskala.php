<?php 

/*Algorytm Kruskala jest kolejnym algorytmem umożliwiającycm wyznaczenie minimalnego drzewa rozpinającego. 
  Jest on podobny do algorytmu Prima i również stanowi algorytm zachłanny. 
  1. Utwórz las (zbior drzew) T, w którym każdy wierzchołek grafu stanowi osobne drzewo. 
  2. Utwórz zbiór S zawierający wszystkie kraweędzie należące do grafu.
  3. Dopóki S nie jest zbiorem pustym oraz T nie jest drzewem rozpinającym:
  a) Usuń ze zbioru S krawędź o najmniejszej wadze.
  b) Jeśli ta krawędź łączy dwa różne drzewa, dodaj ją do asu, łączac te dwa drzewa
  w jedno; w przeciwym razie odrzuć tę krawędź. 
*/

function Kruskal(array $graph): array {

    $len = count($graph);
    $tree = [];

    $set = [];
    foreach ($graph as $k => $adj){
        $set[$k] = [$k];
    }

    $edges = [];
    for($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($graph[$i][$j]) {
                $edges [$i . ',' . $j] = $graph[$i][$j];
            }
        }
    }

    asort($edges);

    foreach ($edges as $k => $w) {
        list($i, $j) = explode(',', $k);
        $iSet = findSet($set, $i);
        $jSet = findSet($set, $j);
        if($iSet != $jSet) {
            $tree[] = ["from" => $i, "to" => $j, "cost" => $graph[$i][$j]];
            unionSet($set, $iSet, $jSet);
        }
    }
    return $tree; 
}

function findSet(array &$set, int $index){
    foreach($set as $k => $v) {
        if (in_array($index, $v)){
            return $k;
        }
    }
    return false;
}

function unionSet(array &$set, int $i, int $j) {
    $a = $set[$i];
    $b = $set[$j];
    unset($set[$i], $set[$j]);
    $set[] = array_merge($a, $b);
}


$graph = [
    [0,3,1,6,0,0],
    [3,0,5,0,3,0],
    [1,5,0,5,6,4],
    [6,0,5,0,0,2],
    [0,3,6,0,0,6],
    [0,0,4,2,6,0]
];

$mst = Kruskal($graph);

$minimumCost = 0; 

foreach ($mst as $v) {
    echo "Od {$v['from']} do {$v['to']} koszt wynosi {$v['cost']} \n";
    $minimumCost += $v['cost'];
}
echo "Minimalny koszt: $minimumCost \n";