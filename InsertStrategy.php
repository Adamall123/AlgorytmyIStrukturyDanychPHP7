<?php

interface InsertStrategy{
    public function insert(string $data = NULL, LinkedList &$linkedList, int $priority = 0); 
}