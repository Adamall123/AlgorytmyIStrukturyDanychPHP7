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