<?php 


/* 
    Memoizacja to technika optymalizacji polegająca na zapamiętywaniu
    wykonanych wcześniej kosztownych obliczeniowo operacji i 
    wykorzystaniu tych wyników bez konieczności ponownego 
    przeprowadzenia odpowiednich działań. Umożliwia ona na znaczne
    przyśpieszenie rozwiązywania różnych zadań. 
    Należy jednak tu pamiętać, że chodź oszczędzamy czas to 
    do zapisywania wyników potrzebne jest więcej pamięci podręcznej
*/

$startTime = microtime();

$count = 0;

function fibonacci(int $n): int {
    global $count;
    $count++;
    if($n == 0){
        return 1;
    } else if ($n == 1){
        return 1;
    } else{
        return fibonacci($n-1) + fibonacci($n - 2);
    }
}

echo fibonacci(30) . "\n";
echo "Funckja wywołania: " . $count . "\n";
$endTime = microtime();
$totalTime = $endTime - $startTime;
echo "Czas = " . $totalTime . "\n";