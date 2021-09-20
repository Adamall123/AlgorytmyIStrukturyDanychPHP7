<?php

class InsertPriority implements InsertStrategy{
    
    public function insert(string $data = NULL, LinkedList &$linkedList, int $priority = 0){
        $newNode = new ListNode($data, $priority);
        $linkedList->_totalNodes++;
        if($linkedList->frontNode === NULL){
            $linkedList->frontNode = &$newNode;
        }else {
            $previous = $linkedList->frontNode;
            $currentNode = $linkedList->frontNode;
            while($currentNode !== NULL){
                if($currentNode->priority < $priority){
                    
                    if($currentNode == $linkedList->frontNode){
                        $previous = $linkedList->frontNode;
                        $linkedList->frontNode = $newNode; 
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
}