<?php 
/*
    Lista(linked list) to kolekcja obiektów znanych jako węzły. Każdy węzeł jest połączony z następnym węzłem za pomocą łącza (link), które jest po prostu referencją obiektu. 
    W liście jednokierunkowej ostatni element zawiera łącze do następnego elementu będące wartością pustą, co oznacza koniec listy. 
    Węzeł jest obiektem 
*/

class ListNode {
    public $data = NULL; 
    public $next = NULL; 
    public $priority = NULL;
    public function __construct(string $data = NULL, int $priority = NULL){
        $this->data = $data; 
        $this->priority = $priority;
    }
}

class LinkedList implements Iterator{
    public $frontNode = NULL; 
    public $lastNode = NULL; 
    public $_totalNodes = 0; 
    private $_currentNode = NULL; 
    private $_currentPosition = 0; 

    public function getSize(){
        return $this->_totalNodes;
    }
    public function addTotalNodes(){
        $this->_totalNodes++;
    }
    public function current(){
        return $this->_currentNode->data; 
    }
    public function next(){
        $this->_currentPosition++;
        $this->_currentNode = $this->_currentNode->next; 
    }
    public function key(){
        return $this->_currentPosition;
    }
    public function rewind(){
        $this->_currentPosition = 0;
        $this->_currentNode = $this->frontNode;
    }
    public function valid(){
        return $this->_currentNode !== NULL; 
    }

    public function insert(string $data = NULL){
        $newNode = new ListNode($data);
        if($this->frontNode === NULL){
            $this->frontNode = &$newNode;
            $this->lastNode = &$newNode; 
        }else {
            $currentNode = $this->frontNode;
            while($currentNode->next !== NULL){
                $currentNode = $currentNode->next;
            }
            $currentNode->next = $newNode;
        }
        $this->_totalNodes++;
        return true;
    }
    public function insertWithPriority(string $data = NULL, int $priority = NULL){
        $newNode = new ListNode($data);
        $this->_totalNodes++;

        if($this->frontNode === NULL){
            $this->frontNode = &$newNode;
        }else {
            $previous = $this->frontNode;
            $currentNode = $this->frontNode;
            while($currentNode->next !== NULL){
                if($currentNode->priority < $priority){
                    if($currentNode == $this->frontNode){
                        $previous = $this->frontNode;
                        $this->frontNode = $newNode; 
                        $newNode->next = $previous; 
                        return; 
                    }
                    $newNode->next = $currentNode; 
                    $previous->next = $newNode; 
                    return;
                }
                $previous = $currentNode; 
                $currentNode = $currentNode->next; 
            }
        }
        return true;
    }
    public function insertAtFirst(string $data = NULL){
        $newNode = new ListNode($data);
        if($this->frontNode === NULL){
            $this->frontNode = &$newNode;
        }else {
            $newNode->next = $this->frontNode;
            $this->frontNode = &$newNode;
            /*in the book
            $currentFronttNode = $this->_frondNode
            $this->frontNode = &$newNode;
            $newNode->next = $currentFronttNode;
            */
        }
        $this->_totalNodes++;
        return true;
    }
    public function display(){
        echo "\nWszystkich elementow na liscie: " . $this->_totalNodes . "\n";
        $currentNode = $this->frontNode;
        while($currentNode !== NULL){
            echo $currentNode->data . ' -> '; 
            $currentNode = $currentNode->next;
        }
        echo ' NULL';
    }
    public function insertBefore(string $data = NULL, string $query = NULL){
        $newNode = new ListNode($data);
        if($this->frontNode){
            //in book previous is equaled to Null but then program outputs error on line 69 when refer to method that instead of object it was null
            $previous = $this->frontNode; 
            $currentNode = $this->frontNode;
            while($currentNode !== NULL){
                if($currentNode->data === $query){
                    $newNode->next = $currentNode;
                    $previous->next = $newNode;
                    $this->_totalNodes++;
                    break;
                }
                $previous = $currentNode;
                $currentNode = $currentNode->next;
            }
        }
    }
    public function insertAfter(string $data = NULL, string $query = NULL) {
        $newNode = new ListNode($data);
        if($this->frontNode){
            $nextNode = NULL; 
            $currentNode = $this->frontNode;
            while($currentNode !== NULL){
                if($currentNode->data === $query){
                    if($nextNode !== NULL) {
                        $newNode->next = $nextNode; 
                    }
                    $currentNode->next = $newNode;
                    $this->_totalNodes++;
                    break;
                }
                $currentNode = $currentNode->next;
                $nextNode = $currentNode->next;  
            }
        }
    }
    public function deleteNode(string $query){
        if($this->frontNode){
            $previous = $this->frontNode;
            $currentNode = $this->frontNode;
            while($currentNode !== NULL){
                if($currentNode->data === $query){
                    if($currentNode->next === NULL) {
                        $previous->next = NULL; 
                    }else {
                        $previous->next = $currentNode->next; 
                    }
                    $this->_totalNodes--;
                    break;
                }
                $previous = $currentNode;
                $currentNode = $currentNode->next;
            }
        }
    }
    public function deleteFirst(){
        if($this->frontNode !== NULL){
            if($this->frontNode->next !== NULL){
                $this->frontNode = $this->frontNode->next;
            }else {
                $this->frontNode = NULL; 
            }
            $this->_totalNodes--;
            return true;
        }
        return false;
    }
    public function deleteLast(){
        if($this->frontNode){
            $currentNode = $this->frontNode;
            if($currentNode->next === NULL){
                $this->frontNode = NULL; 
            } else {
                $previousNode = NULL; 
                while($currentNode->next !== NULL){
                    $previousNode = $currentNode; 
                    $currentNode = $currentNode->next; 
                }
                $previousNode->next = NULL; 
                $this->_totalNodes--;
                return true; 
            }
        }
        return false; 
    }
    /*
    Przejście przez wszystkie węzły i zastąpienie następnego elementu poprzednim, poprzedniego - bieżącym oraz bieżącego - następnym 
    */
    public function reverse(){
        if($this->frontNode !== NULL){
            if($this->frontNode->next !== NULL){
                $reversedList = NULL; 
                $nextNode = NULL; 
                $currentNode = $this->frontNode;
            }
            while($currentNode !== NULL){
                $nextNode = $currentNode->next; 
                $currentNode->next = $reversedList; 
                $reversedList = $currentNode;
                $currentNode = $nextNode;
            }
            $this->frontNode = $reversedList;
        }
    }
    public function getNthNode(int $n = 0){
        $count = 1; 
       
        if($this->frontNode !== NULL){
            $currentNode = $this->frontNode;
            
            while($currentNode !== NULL){
                if($count === $n){
                    return $currentNode;
                }
                $count++;
                $currentNode = $currentNode->next; 
            }
            exit;
        }
    }
    public function search(string $data){
        if($this->_totalNodes){
            $currentNode = $this->frontNode;
            while($currentNode->next !== NULL){
                if ($currentNode->data === $data ) return $currentNode;
                $currentNode = $currentNode->next;
            }
        }
        return false; 
    }
}

$linkedList = new LinkedList();
$linkedList->insert(37);
$linkedList->insertAtFirst(16);
$linkedList->insert(25);
$linkedList->insert(10);
$linkedList->insert(52);

$linkedList->insertBefore(19,25);
$linkedList->insertAfter(49,25);
$linkedList->deleteNode(25);
$linkedList->display(); 


//echo "\nZnaleziono: " . ($linkedList->search(10)->data);


$linkedList->reverse();
$linkedList->display();

$bookTitles = new LinkedList();
$bookTitles->insertAtFirst("Kocham Programowac");
$bookTitles->insert("Wprowadzenie do algorytmow");
$bookTitles->insert("Wprowadzenie do PHP i struktur danych");
$bookTitles->insertAtFirst("Wzorce, Obiekty, PHP");
$bookTitles->insert("Programowanie sztucznej inteligencji");
// $bookTitles->display();

// echo "\nDrugi element to: " . $bookTitles->getNthNode(2)->data;
// $bookTitles->reverse();
// $bookTitles->display();


/*
ITEROWANIE PO OBIEKCIE 

Gdy zajdzie potrzeba iterowania z zewnątrz przy użyciu obiektu listy warto skorzystać z interfejsu iteratora który udostępnia nam PHP
Metody jakie zapewnia:
- current: zwraca bieżący element 
- next: przechodzi do następnego elementu
- key: zwraca klucz bieżącego elementu 
- rewind: przewija iterator wstecz do pierwszego elementu 
- valid: sprawdza, czy bieżąca pozycja jest poprawna. 

*/

foreach($bookTitles as $title){
    echo $title . "\n";
}
echo "Iterowanie po obiekcie\n";
for($bookTitles->rewind(); $bookTitles->valid(); $bookTitles->next()){
    echo $bookTitles->current() . "\n";
}

//Budowanie listy cyklicznej 

class CircularLinkedList {
    private $_frontNode = NULL; 
    private $_totalNode = 0; 
    public function insertAtEnd(string $data = NULL){
        $newNode = new ListNode($data);
        if($this->_frontNode === NULL){
            $this->_frontNode = &$newNode; 
        } else {
            $currentNode = $this->_frontNode;
            while($currentNode->next !== $this->_frontNode){
                $currentNode = $currentNode->next; 
            }
            $currentNode->next = $newNode; 
        }
        $newNode->next = $this->_frontNode;
        $this->_totalNode++;
        return TRUE;
    }
    public function display(){
        echo "Wszystkich elementow na liscie: " . $this->_totalNode . "\n";
        $currentNode = $this->_frontNode;
        while($currentNode->next !== $this->_frontNode){
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->next; 
        }
        if ($currentNode){
            echo $currentNode->data . "\n";
        }
    }
}

$circularLinkedList = new CircularLinkedList(); 
$circularLinkedList->insertAtEnd("Hello");
$circularLinkedList->insertAtEnd("What's");
$circularLinkedList->insertAtEnd("Up?");
$circularLinkedList->insertAtEnd("Go programming");
$circularLinkedList->display();

/*
    LISTA DWUKIERUNKOWA 
*/

class ListNodeTwoWay {
    public $data = NULL;
    public $next = NULL;
    public $prev = NULL; 

    public function __construct(string $data = NULL)
    {
        $this->data = $data;         
    }
}

class TwoWayLinkedList {

    private $frontNode = NULL; 
    private $lastNode = NULL; 
    private $totalNode = 0;
    public function insertAtFirst(string $data = NULL){
        $newNode = new ListNodeTwoWay($data); 
        if($this->frontNode === NULL){
            $this->frontNode = &$newNode;
            $this->lastNode = $newNode; 
        } else {
            $currentFirstNode = $this->frontNode; 
            $this->frontNode = &$newNode; 
            $newNode->next = $currentFirstNode; 
            $currentFirstNode->prev = $newNode; 
        }
        $this->totalNode++;
        return true; 
    }
    public function insertAtLast(string $data = NULL){
        $newNode = new ListNodeTwoWay($data);
        if($this->frontNode === NULL){
            $this->frontNode = &$newNode;
            $this->lastNode = $newNode; 
        } else {
            $currentNode = $this->lastNode;
            $currentNode->next = $newNode; 
            $newNode->prev = $currentNode; 
            $this->lastNode = $newNode; 
        }
        $this->totalNode++;
        return true;
    }
    public function insertBefore(string $data = NULL, string $query = NULL){
        $newNode = new ListNodeTwoWay($data);
        if($this->frontNode){
            
            $previous = NULL;
            $currentNode = $this->frontNode;
            while($currentNode !== NULL){
                if($currentNode->data === $query){
                    //added implementation in book not predicted when adding before head then the problem with displaying cause it was starting from head defined on line 327
                    if(is_null($previous)){
                        $this->frontNode = &$newNode;
                    }
                    $newNode->next = $currentNode; 
                    $currentNode->prev = $newNode; 
                    if(!is_null($previous))$previous->next = $newNode;
                    $newNode->prev = $previous;
                    $this->totalNode++;
                    break; 
                }
                $previous = $currentNode; 
                $currentNode = $currentNode->next; 
            }
        } 
    }
    public function insertAfter(string $data = NULL, string $query = NULL){
        $newNode = new ListNodeTwoWay($data);
        if($this->frontNode){
            //in book $nextNode = null - can not work for case when we want insert after first element (head) 
            // then we do not have indicator next for new added element. fixed by assigning indicator next of head. 
            $nextNode = $this->frontNode->next;
            $currentNode = $this->frontNode;
            while($currentNode !== NULL){
                if($currentNode->data === $query){
                    if($nextNode !== NULL){
                        $newNode->next = $nextNode; 
                    }
                    if($currentNode === $this->lastNode){
                        $this->lastNode = $newNode; 
                    }
                    $currentNode->next = $newNode; 
                    if(!is_null($nextNode))$nextNode->prev = $newNode; 
                    $newNode->prev = $currentNode; 
                    $this->totalNode++;
                    break;
                }
                $currentNode = $currentNode->next; 
                $nextNode = $currentNode->next; 
            }
        }
    }
    public function deleteFirst(){
        if($this->frontNode !== NULL){
            if($this->frontNode->next !== NULL){
                $this->frontNode = $this->frontNode->next; 
                $this->frontNode->prev = NULL;
            } else {
                $this->frontNode = NULL; 
            }
            $this->totalNode--;
            return true;
        }
        return false;
    }
    public function deleteLast(){
        if ($this->lastNode !== NULL){
            $currentNode = $this->lastNode;
            if($currentNode->prev === NULL){
                $this->frontNode = NULL;
                $this->lastNode = NULL; 
            } else {
                $previousNode = $currentNode->prev;
                $this->lastNode = $previousNode;
                $previousNode->next = NULL; 
                $this->totalNode--;
                return true;
            }
        }
        return false; 
    }
    public function delete(string $query = NULL) {
        if($this->frontNode){
            $previous = NULL;
            $currentNode = $this->frontNode; 
            while($currentNode !== NULL){
                if($currentNode->data === $query){
                    if($currentNode->next === NULL){
                        if(!is_null($previous)) $previous->next = NULL; 
                    } else {
                        if(!is_null($previous)) $previous->next = $currentNode->next;
                        $currentNode->next->prev = $previous; 
                    }
                    $this->totalNode--;
                    break;
                }
                $previous = $currentNode; 
                $currentNode = $currentNode->next; 
            }
        }
    }
    public function displayForward(){
        echo "Wszystkich elementow na liscie: " . $this->totalNode . "\n";
        $currentNode = $this->frontNode;
        while($currentNode !== NULL){
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->next; 
        }
    }
    public function displayBackward(){
        echo "Wszystkich elementow na liscie: " . $this->totalNode . "\n";
        $currentNode = $this->lastNode;
        while($currentNode !== NULL){
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->prev; 
        }
    }
}

$bookTitles = new TwoWayLinkedList();
$bookTitles->insertAtFirst("Kocham Programowac");
$bookTitles->insertAtFirst("Wzorce, Obiekty, PHP");
$bookTitles->insertAtLast("Programowanie sztucznej inteligencji");
$bookTitles->insertBefore("Wprowadzenie do PHP i struktur danych","Programowanie sztucznej inteligencji");
$bookTitles->insertAfter("test123","Wzorce, Obiekty, PHP");
$bookTitles->insertBefore("test","Wzorce, Obiekty, PHP");
// $bookTitles->deleteFirst();
// $bookTitles->deleteFirst();
// $bookTitles->deleteLast();
$bookTitles->delete("Kocham Programowac");
$bookTitles->delete("test123");

$bookTitles->displayForward();
// $bookTitles->insert("Wprowadzenie do algorytmow");
// $bookTitles->insert("Wprowadzenie do PHP i struktur danych");
// $bookTitles->insertAtFirst("Wzorce, Obiekty, PHP");
// $bookTitles->insert("Programowanie sztucznej inteligencji");

/*
    PHP oferuje implementację 
*/