<?php

class Insert implements InsertStrategy{
    
    public function insert(string $data = NULL, LinkedList &$linkedList, int $priority = NULL){
        $newNode = new ListNode($data);
        if($linkedList->frontNode === NULL){
            $linkedList->frontNode = &$newNode;
            $linkedList->lastNode = &$newNode; 
        }else {
            $currentNode = $linkedList->frontNode;
            while($currentNode->next !== NULL){
                $currentNode = $currentNode->next;
            }
            $currentNode->next = $newNode;
        }
        $linkedList->_totalNodes++;
        echo $linkedList->_totalNodes . "\n";
        
        return true;
    }
}