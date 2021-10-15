<?php 

/*
    Właściwości algorytmów regurencyjnych 
    przykład: obliczanie silni
    
    1. Każde rekurencyjne wywyłoanie powinno dotyczyć mniejszego podproblemu. 
    Obliczanie silni liczby 6 sprowadza się do pomnożenia tej liczby 
    przez silnię liczby 5 itd.
    2. Musi być zdefiniowany przypadek bazowy. Gdy przypadek bazowy zostaje 
    osiągnięty, nie ma już dalszej rekurencji, a przypadek ten powinno
    dać się rozwiązać bez żadnych kolejnych wywołań rekurencyjnych. 
    W przykładzie z silnią gdy dojdziemy do wartości 0, nie schodzimy
    już niżej. A zatem w tym przykładzie przypadkiem bazowym jest wartość 0.
    3. Nie powinien występować żaden cykl. Jeśli w każdym wywołaniu rekurencyjnym
    występuje wywołanie dotyczące tego samego problemu, możemy mieć doczynienia
    z cyklem nieskończonym. Po pewnej liczbie potwórzeń takiego wywołania komputer
    zgłosi błąd przepełnienia stosu. 
*/

//SILNIA

function factorial(int $n): int {
    if($n == 0){
        return 1; 
    }
    return $n * factorial($n - 1);
}

//ciąg Fibonacciego
function fibonacci(int $n): int {
    if($n == 0){
        return 0;
    } else if ($n == 1){
        return 1;
    } else{
        return fibonacci($n-1) + fibonacci($n - 2);
    }
}
echo fibonacci(6);
//implementacja obliczania NWD za pomocą rekurencji (Greatest Common Division - GCD)

function gcd(int $a, int $b): int {
    if($b == 0){
        return $a;
    } else {
        return gcd($b, $a % $b);
    }
}

//Złota zasada: zacząć od zastanowienia się jaki jest przypadek podstawowy 

/*
    Różne rodzaje rekurencji 
    REKURENCJA LINIOWA
    Jest ona jedną z najczęściej wykorzystywanych. Mamy z nią doczynienia gdy funkcja
    w danym przebiegu wywołuje samą siebie tylko jeden raz. przykład: obliczanie silni,
    w którym rozbijane są duże obliczenia na mniejsze aż do momentu osiągnięcia
    przypadku bazowego. Proces ten nazywany jest nawijaniem (winding). Proces polegający
    na powracaniu z przypadku bazowego do pierwszego wywołania rekurencyjnego określany 
    jest mianem odwijania (unwinding). 
    REKURENCJA BINARNA 
    W przypadku rekurencji binarnej funkcja wywołuje się w każdym przejściu dwukrotnie. 
    W związku z tym wynik obliczenia zależy od dwóch wyników zwróconych przez dwa rekurencyjne
    wywołania tej samej funkcji. Ciąg fibonnaciego jest tego przykładem. 
    Przykładami mogą być np. algorytmy wyszukiwania binarnego, dziel i zwyciężaj oraz
    sortowanie przez scalanie. 
    REKURENCJA OGONOWA
    Funkcja działa zgodnie z logiką rekurencji ogonowej, gdy nie ma żadnej operacji oczekującej 
    na wykonanie przy powrocie. Przykładem jest NWD , po powrocie nie jest już wykonywana 
    żadna operacja. A zatem ostatnia zwrócona wartość czy też wartość zwrócona przez przypadek
    bazowy jest poszukiwaną odpowiedzią.
    
*/