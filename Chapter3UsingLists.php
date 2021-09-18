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

    public function display(){
        echo "\nWszystkich elementow na liscie: " . $this->_totalNodes . "\n";
        $currentNode = $this->frontNode;
        while($currentNode !== NULL){
            echo $currentNode->data . ' -> '; 
            $currentNode = $currentNode->next;
        }
        echo ' NULL';
    }
}

$linkedList = new LinkedList();
$linkedList->insert(37);
$linkedList->insert(25);
$linkedList->insert(10);
$linkedList->insert(52);
$linkedList->display(); 

$bookTitles = new LinkedList();
$bookTitles->insert("Wprowadzenie do algorytmow");
$bookTitles->insert("Wprowadzenie do PHP i struktur danych");
$bookTitles->insert("Programowanie sztucznej inteligencji");
$bookTitles->display();