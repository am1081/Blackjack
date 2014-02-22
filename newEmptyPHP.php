<?php




$hello = new Person();

class Person {
    
    private $hand;
    function __construct() {
        
    }
    private function hit() {
        $hand->addCard();
        return $this;
    }
}

