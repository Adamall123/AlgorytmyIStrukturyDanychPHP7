<?php 

/*
    Pattern matching polega w większości przypadków na wyrażeniach regularnych 
    Język oferuje funcje strops, która zwraca pozycję pierwszego wystąpienia
    danego łańcucha znakowego w tekście. 
*/

function strFindAll(string $pattern, string $txt): array 
{
    $M = strlen($pattern);
    $N = strlen($txt);
    $positions = [];

    for($i = 0; $i <= $N - $M; $i++){
        for($j = 0; $j < $M; $j++)
            if($txt[$i + $j] != $pattern[$j]) break;
            if($j == $M)
                $positions[] = $i;
    }
    return $positions;
}

$txt = "AABAACAADAABABBBAABAA";
$pattern = "AABA";
$matches = strFindAll($pattern, $txt);

if($matches){
    foreach ($matches as $pos){
        echo "Wzorzec znaleziony pod indeksem " .  $pos . "\n";
    }
}