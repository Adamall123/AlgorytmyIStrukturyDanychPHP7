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
// echo fibonacci(6);
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

class Category {
    //as only for training propertiees are set to public 
    public $id;
    public $categoryName; 
    public $parentCategory;
    public $SortInd; 

    function __construct($id, $categoryName, $parentCategory, $SortInd) {
        $this->id = $id; 
        $this->categoryName = $categoryName;
        $this->parentCategory = $parentCategory;
        $this->SortInd = $SortInd;
    }
}

$one = new Category(1, "Pierwsza", 0, 0);
$two = new Category(2, "Druga", 1, 0);
$three = new Category(3, "Trzecia", 1, 1);
$four = new Category(4, "Czwarta", 3, 0);
$five = new Category(5, "Piata", 4, 0);
$six = new Category(6, "Szosta", 5, 0);
$seven = new Category(7, "Siodma", 6, 0);
$eight = new Category(8, "Osma", 7, 0);
$nine = new Category(9, "Dziewiata", 1, 0);
$ten = new Category(10, "Dziesiata", 2, 1);

$categories[0][] = $one; 
$categories[1][] = $two; 
$categories[1][] = $three; 
$categories[3][] = $four; 
$categories[4][] = $five; 
$categories[5][] = $six; 
$categories[6][] = $seven; 
$categories[7][] = $eight; 
$categories[1][] = $nine; 
$categories[2][] = $ten; 


function showCategoryTree(Array $categories, int $n)
{
    if(isset($categories[$n]))
    {

        foreach($categories[$n] as $category)
        {
            echo str_repeat("-", $n)."".$category->categoryName."\n";
            showCategoryTree($categories, $category->id);
        }
    }
    return;
}

showCategoryTree($categories, 0);

/*
    Przedstawiony powyżej kod odpowiada za rekurencyjne wyświetlanie kategori i ich kategorii potomnych. 
    Zaczynamy od wzięcia pewnego poziomu i wyświetlenia kategorii znajdującej się na tym poziomie. Za 
    pomocą instrukcji ShoCategoryTree($categories, $category->id) sprawdzamy od razu, czy ma ona jakieś
    kategorie poziomu dziecka. Jeśli wywołamy naszą rekurencyjną funkcję z argumentem wskazującycm
    korzeń struktury (tutaj poziom 0) to na ekreanie zostanie pokazane całe drzewo. 
    Na podanym przykładzie widać ,że da się budować zagnieżdżone struktury kategorii lub menu, 
    BEZ KONIECZNOŚCI PRZEJMOWANIA SIĘ LICZBĄ POZIOMÓW KATEGORII czy tworzenia wielu zapytań
    bazodanowych, lecz wyłącznie za pomocą prostego zapytania i odpowiednio napisanej funkcji rekurencyjnej.
    Jest to przykład rekurencji igonowej, w której wyświetlamy kolejne wyniki z postępem rekurencji.
    Unikamy implementacje związane z liczbą klauzul join. 
 */