<?php

class TreeNode {
    public $data = NULL;
    public $children = [];

    public function __construct(string $data = NULL) {
        $this->data = $data;
    }
    
    public function addChildren(TreeNode $node){
        $this->children[] = $node; 
    }
}

class Tree {
    public $root = NULL; 

    public function __construct(TreeNode $node){
        $this->root = $node; 
    }

    public function traverse(TreeNode $node, int $level = 0)
    {
        if($node)
        {
            echo str_repeat("-", $level);
            echo $node->data . "\n";

            foreach( $node->children as $childNode){
                $this->traverse($childNode, $level + 1);
            }
        }
    }
}

$ceo = new TreeNode("Prezes");
$tree = new Tree($ceo); 

$cto = new TreeNode("dyrektor ds. technicznych");
$cfo = new TreeNode("dyrektor ds. finanswocyh");
$cmo = new TreeNode("dyrektor ds. marketingowych");
$coo = new TreeNode("dyrektor ds. operacyjnych");

$ceo->addChildren($cto);
$ceo->addChildren($cfo);
$ceo->addChildren($cmo);
$ceo->addChildren($coo);

$seniorArchitect = new TreeNode("starszy architekt");
$softwareEngineer = new TreeNode("programista");
$userInterfaceDesigner = new TreeNode("projektant interfejsu uzytkownika");
$qualityAssuranceEnineer = new TreeNode("tester");

$cto->addChildren($seniorArchitect);
$seniorArchitect->addChildren($softwareEngineer);
$cto->addChildren($qualityAssuranceEnineer);
$cto->addChildren($userInterfaceDesigner);

$tree->traverse($cto->root);