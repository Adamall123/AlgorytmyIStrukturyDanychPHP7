<?php 
/*
    Lista(linked list) to kolekcja obiektów znanych jako węzły. Każdy węzeł jest połączony z następnym węzłem za pomocą łącza (link), które jest po prostu referencją obiektu. 
    W liście jednokierunkowej ostatni element zawiera łącze do następnego elementu będące wartością pustą, co oznacza koniec listy. 
    Węzeł jest obiektem 
*/

class ListNode {
    public $data = NULL; 
    public $next = NULL; 

    public function __construct(string $data = NULL){
        $this->data = $data; 
    }
}

class LinkedList {
    private $frontNode = NULL; 
    private $_totalNodes = 0; 

    public function insert(string $data = NULL){
        $newNode = new ListNode($data);
        if($this->frontNode === NULL){
            $this->frontNode = &$newNode;
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
    public function insertBefore(string $searchedData, string $data){
        $searchedNode = $this->search($searchedData);
        $currentNode = $this->frontNode;
        if($searchedNode){
            while($currentNode->next !== $searchedNode){
                $currentNode = $currentNode->next;
            }
            $newNode = new ListNode($data);
            $currentNode->next = $newNode;
            $newNode->next = $searchedNode; 
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

$linkedList->insertBefore(25,19);

$linkedList->display(); 

echo "\nZnaleziono: " . ($linkedList->search(10)->data);

$bookTitles = new LinkedList();
$bookTitles->insertAtFirst("Kocham Programowac");
$bookTitles->insert("Wprowadzenie do algorytmow");
$bookTitles->insert("Wprowadzenie do PHP i struktur danych");
$bookTitles->insertAtFirst("Wzorce, Obiekty, PHP");
$bookTitles->insert("Programowanie sztucznej inteligencji");
$bookTitles->display();