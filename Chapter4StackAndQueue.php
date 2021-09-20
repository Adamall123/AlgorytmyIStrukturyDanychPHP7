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

    public function enqueue(string $item);
    
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

    public function enqueue(string $newItem){
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

    public function __construct(int $limit = 20){
        $this->limit = $limit; 
        $this->queue = new LinkedList();
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

    public function enqueue(string $newItem)
    {
        if($this->queue->getSize() < $this->limit){
            $this->queue->insert($newItem);
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

//SplQueue
echo "SplQueue\n";
try{
    $agents = new SplQueue();
    $agents->enqueue("Franek");
    $agents->enqueue("Janek");
    $agents->enqueue("Krzysiek");
    $agents->enqueue("Adrian");
    $agents->enqueue("Michal");
    echo $agents->dequeue() . "\n";
    echo $agents->dequeue() . "\n";
    echo $agents->bottom() . "\n";
}catch(Exception $e){
    $e->getMessage();
}