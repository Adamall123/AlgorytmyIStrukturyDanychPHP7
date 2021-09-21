<?php 
/*
    STOS
    Stos jest liniową strukturą danych, która działa zgodnie z regułą ostatnie na wejściu, pierwszy na wyjściu (LIFO). Oznacza to ,że stos ma tylko jedną stronę, 
    z której możemy korzystać, aby dodawać i usuwać elementy. Dodawanie elementów na stos określane jest jako odkładanie ich na stos lub umieszczanie na stosie
    (push), a operacja usunięcia nosi nazwę zdejmowania lub pobierania danych ze stosu (pop). Jako że mamy do dyspozycji mamy tylko jeden koniec stosu, 
    odkładanie i zdejmowanie realizowane jest zawsze w odniesieniu do tego końca. Element znajdujący się na tym końcu, czyli na samym wierzchu stosu, określany
    jest mianem szczytu lub wierzchołka (top) stosu. Operacje na stosie przeprowadzane są zawsze na jego szczycie. 
*/
// IMPLEMENTACJA STOSU ZA POMOCĄ TABLICY PHP 

require_once('Chapter3UsingLists.php');
require_once('InsertStrategy.php');
require_once('Insert.php');
require_once('InsertPriority.php');

interface Stack {
    public function push(string $item);

    public function pop(); 

    public function top(); 

    public function isEmpty();
}

class Books implements Stack{
    private $limit; 
    private $stack; 
    public function __construct(int $limit = 20){
        $this->limit = $limit; 
        $this->stack = [];
    }
    public function pop(): string {
        if($this->isEmpty()){
            throw new UnderflowException('Stack is empty.');
        } else {
            return array_pop($this->stack);
        }
    }
    public function push(string $newItem){
        if(count($this->stack) < $this->limit){
            array_push($this->stack, $newItem);
        } else {
            throw new OverflowException("Stack is full.");
        }
    }
    public function top(): string {
        return end($this->stack);
    }
    public function isEmpty(): bool {
        return empty($this->stack);
    }
}

try{
    $programmingBooks = new Books(10);
    $programmingBooks->push("Wprowadzenie do PHP 7");
    $programmingBooks->push("Rusz glowa - wzorce projektowe");
    $programmingBooks->push("Rusz glowa - sql");
    echo $programmingBooks->pop() . "\n";
    echo $programmingBooks->top() . "\n";
}catch(Exception $e){
    $e->getMessage();
}

//IMPLEMENTACJA STOSU ZA POMOCĄ LISTY 

class BookList implements Stack {
    private $stack; 

    public function __construct(){
        $this->stack = new LinkedList(); 
    }

    public function top(): string {
        return $this->stack->getNthNode($this->stack->getSize())->data; 
    }

    public function isEmpty(): bool {
        return $this->stack->getSize() == 0;
    }

    public function pop(): string{
        
        if($this->isEmpty()){
            throw new UnderflowException("Stack is empty");
        }else {
            $lastItem = $this->top();
            $this->stack->deleteLast(); 
            return $lastItem;
        }
    }
    public function push(string $newItem){
        $this->stack->insert($newItem);
    }
}

try{
    echo "Książki - stos - lista \n";
    $programmingBooks = new BookList();
    $programmingBooks->push("Wprowadzenie do PHP7");
    $programmingBooks->push("Rusz glowa - wzorce projektowe");
    $programmingBooks->push("Rusz glowa - sql");
   
    echo $programmingBooks->pop() . "\n";
    echo $programmingBooks->pop() . "\n";
    echo $programmingBooks->top() . "\n";

}catch(Exception $e) {
    echo $e->getMessage();
}

// Stos ma zastosowania w wielu nowoczesnych aplikacjach  np. przykładami mogą być historia odwiedzanych stron przechowywana przez przeglądarkę. 

function expressionChecker(string $expression): bool {
    $valid = true; 
    $stack = new SplStack(); 

    for ($i = 0; $i < strlen($expression); $i++){
        $char = substr($expression, $i, 1);
        switch($char){
            case '(':
            case '{':
            case '[': 
                $stack->push($char);
                break;
            case ')': 
            case '}':
            case ']': 
                if($stack->isEmpty()){
                    $valid = false; 
                } else {
                    $last = $stack->pop(); 
                    if ( ($char == ")" && $last != '(') || ($char == "}" && $last != '{') || 
                        ($char == "]" && $last != '[')){
                            $valid = false;
                        }
                }
                break;
        }
        if(!$valid) 
            break;
    }
    if(!$stack->isEmpty()){
        $valid = false;
    }
    return $valid; 
}

$expressions = [];
$expressions[] = "8 * ( 9 - 2) + { (4 * 5) / ( 2 * 2) }";
$expressions[] = "5 * 8 * 9 / (3 * 2) )";
$expressions[] = "[ (]{ ( 2 * 7) + (15 - 3) }]";

foreach ($expressions as $expression){
    $valid = expressionChecker($expression);
    if($valid){
        echo "Wyrazenie jest prawidlowe \n";
    } else {
        echo "Wyrazenie jest nieprawidlowe \n";
    }
}

/*
    Kolejna to liniowa struktura danych, działająca zgodnie z zasadą pierwszy na wejściu, pierwszy na wyjśćiu (FIFO). Operacje odbywaja się
    na dwóch końcach kolejki: jeden z nich służy do dodawania elementów,a drugo do usuwania. Odróżnia to kolejkę od stosu, w przypadku którego
    obydwa te działania obdywały się na końcu kolejki. Usuwanie elementów przeprwoadza się na jej początku czy też z przodu. Operacja 
    dodawania nowego elementu do kolejki znana jest jako zakolejkowanie (enqueue) , a operacje usuwania mozna oreślić słowem "wykolejkowanie",
    "zdekolejkowanie (dequeue). Pobieranie elementu znajdującego się na początku kolejki bez usuwania go znane jest jako zerkanie lub poglądanie
    (peek) i stanowi operację analogiczną do operacji wykonaywanej na stosie przez metodę top. 
*/

interface Queue{

    public function enqueue(string $item, int $prior = 0);
    
    public function dequeue(); 

    public function peek(); 

    public function isEmpty(); 
}
// IMPLEMENTACJA KOLEJKI ZA POMOCĄ TABLICY PHP 

class AgentQueue implements Queue{
    private $limit; 
    private $queue;
    
    public function __construct(int $limit = 20){
        $this->limit = $limit;
        $this->queue = [];
    }

    public function dequeue(): string{
        if($this->isEmpty()){
            throw new UnderflowException("Queue is empty.");
        }else {
            return array_shift($this->queue);
        }
    }

    public function enqueue(string $newItem, int $prior = 0){
        if(count($this->queue) < $this->limit){
            array_push($this->queue, $newItem);
        } else {
            throw new OverflowException("Queue is full.");
        }
    }

    public function peek(): string{
        return current($this->queue);
    }
    
    public function isEmpty(): bool{
        return empty($this->queue);
    }
}
echo "PHP array\n";
try{
    $agents = new AgentQueue(10);
    $agents->enqueue("Franek");
    $agents->enqueue("Janek");
    $agents->enqueue("Krzysiek");
    $agents->enqueue("Adrian");
    $agents->enqueue("Michal");
    echo $agents->dequeue() . "\n";
    echo $agents->dequeue() . "\n";
    echo $agents->peek() . "\n";
}catch(Exception $e){
    $e->getMessage();
}

class AgentQueueList implements queue{
    private $limit;
    private $queue;
    private InsertStrategy $insertStrategy; 
    public function __construct(int $limit = 20, InsertStrategy $insertStrategy){
        $this->limit = $limit; 
        $this->queue = new LinkedList();
        $this->insertStrategy = $insertStrategy; 
    }
    public function display(){
        $this->queue->display(); 
    }
    public function returnQueue(): LinkedList{
        return $this->queue;
    }
    public function dequeue(): string{
        if($this->isEmpty()){
            throw new UnderflowException("Queue is empty.");
        } else {
            $lastItem = $this->peek(); 
            $this->queue->deleteFirst(); 
            return $lastItem; 
        }
    }

    public function enqueue(string $newItem, int $prior = 0)
    {
        if($this->queue->getSize() < $this->limit){
            //$this->queue->insert($newItem);
            $this->insertStrategy->insert($newItem, $this->queue, $prior);
        }else{
            throw new OverflowException("Queue is full.");
        }
    }

    public function peek(): string{
        return $this->queue->getNthNode(1)->data;
    }

    public function isEmpty(): bool{
        return $this->queue->getSize() == 0; 
    }
}
echo "LinkedList\n";
try{
    $agents = new AgentQueueList(10, new Insert());
    $agents->enqueue("Franek");
    $agents->enqueue("Janek");
    $agents->enqueue("Krzysiek");
    $agents->enqueue("Adrian");
    $agents->enqueue("Michal");
    echo $agents->dequeue() . "\n";
    echo $agents->dequeue() . "\n";
    echo $agents->peek() . "\n";
}catch(Exception $e){
    $e->getMessage();
}

//SplQueue
// echo "SplQueue\n";
// try{
//     $agents = new SplQueue();
//     $agents->enqueue("Franek");
//     $agents->enqueue("Janek");
//     $agents->enqueue("Krzysiek");
//     $agents->enqueue("Adrian");
//     $agents->enqueue("Michal");
//     echo $agents->dequeue() . "\n";
//     echo $agents->dequeue() . "\n";
//     echo $agents->bottom() . "\n";
// }catch(Exception $e){
//     $e->getMessage();
// }

//KOLEJKA PRIORYTETOWA

/*
Kolejka priorytetowa to specjalny rodzaj kolejki, w przypadku której elementy są wstawiane i usuwane zgodnie z priorytetem.
W świecie programowania komputerowego zastosowanie kolejki priorytetowej jest ogromne. Przykład: jest bardzo duży system
kolejkowana wiadomości poczty elektronicznej, który wykorzystujemy do rozsyłania comiesięcznego biuletynu. Co gdy zachodzi
potrzeba rozesłania do użytkowników jakiejś niezwykle pilnej wiadomości za pomocą tego systemu? Ogólna zasada działania 
kolejek jest taka ,że każdy element dodaje się na jej końcu, doręczenie wówczas naszej wiadomości będzie bardzo mocno
opóźnione. Aby rozwiązać ten problem, możemy skorzystać z kolejki priorytetowej. W takim przypadku do każdego węzła przypisuje
się pewien priorytet i wszystkie węzły sortuje się zgodnie z ich priorytetami. Element o wyższym priorytecie zostanie 
przeniesiony na początek listy, w związku z czym zostanie on obsłużony wcześniej niż węzły o niższych priorytetach. 

Kolejke priorytetową można podzielić na 2 sposoby:

1) SEKWENCJA UPORZĄDKOWANA

Jeśli implementując kolejkę priorytetową, zdecydowaliśmy się użyć sekwencji uporządkowanej , możemy w jej przypadku 
zastosować porządek rosnący lub malejący. Dobrą stroną korzystania z tego rodzaju sekwencji jest to, że możemy 
szybko w niej znaleźć lub z niej usunąć element o najwyższym priorytecie; złożoność tego rodzaju operacji wynosi O(1)
Więcej czasu zajmie jednak wstawianie elementu, ponieważ będzie ono wymagało sprawdzenia każdego elementu kolejki
w celu umieszczenia nowego węzła w miejscu odpowiednim ze względu na jego priorytet

2) SEKWENCJA NIEUPORZĄDKOWANA 

Zastosowanie sekcji nieuporządkowanej nie zmusza nas do przechodzenia przez każdy element kolejki w celu umieszczenia
w niej nowo dodanego elementu. Dodaje się do do końca kolejki, zgodnie z ogólną zasadą działania kolejek. Dzięki temu 
złożoność operacji kolejkowania wynosi O(1). Jeśli jednak chcemy wyszukać lub usunąć element o najwyższym priorytecie, 
musimy przejść przez każdy element kolejki, aby znaleźć właściwy węzeł. Co za tym idzie, rozwiązanie to nie jest 
najlepsze , gdy chodzi o operacje wyszukiwania. 

*/

// IMPLEMENTACJA KOLEJKI PRIORYTETOWEJ PRZY UŻYCIU OPORZĄDKOWANEJ SEKWENCJI REALIZOWANEJ ZA POMOCĄ LISTY 

try{
    $agents = new AgentQueueList(10, new InsertPriority());
    $agents->enqueue("Franek", 1);
    $agents->enqueue("Janek", 2);
    $agents->enqueue("Krzysiek", 3);
    $agents->enqueue("Adrian", 4);
    $agents->enqueue("Michal", 2);
    $agents->display(); 
}catch(Exception $e){
    $e->getMessage();
}

/* 
    IMPLEMENTACJA KOLEJKI PRIORYTETOWEJ ZA POMOCĄ KLASY SplPriorityQueue
    Język PHP zapewnia wsparcie dla implementacji kolejki priorytetowej za pomocą SPL. Do utworzenia tego rodzaju
    struktury danych możemy wykorzystać klasę SplPriorityQueue.
*/

class MyPQ extends SplPriorityQueue{
    public function compare($priority1, $priority2){
        if($priority1 === $priority2) return 0;
        return $priority1 > $priority2 ? -1 : 1;
        //return $priority1 <=> $priority2;
    }
}
    echo "\nSplPriorityQueue\n";
    $agents = new MyPQ();

    $agents->insert("Franek", 1);
    $agents->insert("Janek", 2);
    $agents->insert("Krzysiek", 3);
    $agents->insert("Adrian", 4);
    $agents->insert("Michal", 2);

    $agents->setExtractFlags(MyPQ::EXTR_BOTH);

    $agents->top(); 

    while($agents->valid()){
        $current = $agents->current();
        echo $current['data'] . "\n";
        $agents->next();
    }