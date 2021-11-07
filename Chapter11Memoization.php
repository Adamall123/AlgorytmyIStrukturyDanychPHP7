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
$fibCashe = [];
$count = 0;

function fibonacciMemoized(int $n): int {
    global $fibCashe;
    global $count;
    $count++;
    if($n == 0 || $n == 1){
        return 1;
    } else{

        if(isset($fibCashe[$n - 1])) 
        {
            $tmp  = $fibCashe[$n - 1];
        }else {
            $tmp = fibonacciMemoized($n -1);
            $fibCashe[$n - 1] = $tmp; 
        }

        if(isset($fibCashe[$n - 2])) 
        {
            $tmp1  = $fibCashe[$n - 2];
        }else {
            $tmp1 = fibonacciMemoized($n - 2);
            $fibCashe[$n - 1] = $tmp1; 
        }
        return $tmp + $tmp1;
    }
}

echo fibonacciMemoized(30) . "\n";
echo "Funckja wywołania: " . $count . "\n";
$endTime = microtime();
$totalTime = $endTime - $startTime;
echo "Czas = " . $totalTime . "\n";

// W kodzie funkcji sprawdzamy czy liczba , której szukamy jest w tablicy, jeśli tak to nie obliczamy jej ponownie
// a wykorzystujemy zapisaną wcześniej wartość Czas wywołań i wykonania sięfunkcji jest dużo szybszy