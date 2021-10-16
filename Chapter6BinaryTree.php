<?php 

class BinaryNode {
    public $data; 
    public $left; 
    public $right; 

    public function __construct(string $data = NULL){
        $this->data = $data;
        $this->left = NULL;
        $this->right = NULL;
    }

    public function addChildren(BinaryNode $left, BinaryNode $right){
        $this->left = $left;
        $this->right = $right; 
    }
}

class BinaryTree {

    public $root = NULL; 

    public function __construct(BinaryNode $node)
    {
        $this->root = $node; 
    }

    public function traverse(BinaryNode $node, int $level = 0)
    {
        if($node)
        {
            echo str_repeat("-", $level);
            echo $node->data . "\n";
            
            if($node->left)
                $this->traverse($node->left, $level + 1);
            
            if($node->right)
                $this->traverse($node->right, $level + 1);
        }
    }
}

$final = new BinaryNode("Final");

$tree = new BinaryTree($final);

$semiFinal1 = new BinaryNode("Polfinal 1");
$semiFinal2 = new BinaryNode("Polfinal 2");

$quarterFinal1 = new BinaryNode("Cwiercfinal 1");
$quarterFinal2 = new BinaryNode("Cwiercfinal 2");
$quarterFinal3 = new BinaryNode("Cwiercfinal 3");
$quarterFinal4 = new BinaryNode("Cwiercfinal 4");

$semiFinal1->addChildren($quarterFinal1, $quarterFinal2);
$semiFinal2->addChildren($quarterFinal3, $quarterFinal4);

$final->addChildren($semiFinal1, $semiFinal2);

$tree->traverse($tree->root);

echo "\nImplementacja drzewa binarnego za pomocą tablicy PHP\n";
/*
    Przy ustaleniu ,że w tym drzewie binarnym węzły są uporządkowane jako korzeń - 0 , lewy dziecko 1 prawe dziecko 2 
    dziecko 1-go lewe 3 prawe 4 dziecko 2-go lew 5 prawe 6 
    dziecko 3-go lewe 7 prawe 8 dziecko 4-go lewe 9 prawe 10 
    dziecko 5-go lewe 11 

    Dzięki temu można zauważyć prosty wzór 
    jeśli i jest numerem węzła wówczas:
    Lewy węzeł = 2 X i + 1
    Prawe węzeł 2 X (i + 1)
*/
$nodes = [];
$nodes[] = "Final";
$nodes[] = "Polfinal 1";
$nodes[] = "Polfinal 2";
$nodes[] = "Cwiercfinal 1";
$nodes[] = "Cwiercfinal 2";
$nodes[] = "Cwiercfinal 3";
$nodes[] = "Cwiercfinal 4";


class BinaryTreeAr {
    public $nodes = [];

    public function __construct(Array $nodes)
    {
        $this->nodes = $nodes; 
    }

    public function traverse(int $num = 0, int $level = 0) {

        if(isset($this->nodes[$num])){
            echo str_repeat("-", $level);
            echo $this->nodes[$num] . "\n";

            $this->traverse(2 * $num + 1, $level + 1);
            $this->traverse(2 * ($num + 1), $level + 1);
        }
    }
}

    $tree = new BinaryTreeAr($nodes);
    $tree->traverse(0);