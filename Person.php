<?php 

namespace Blackjack;

class Person {

    public $hand = Array();
    
    public function hit($hand = 0)
    {
        $this->hand[$hand]->addCard();
    }
    
    public function isBust($hand = 0)
    {
        if($this->hand[$hand]->getValue() > 21){
            return true;
        } else {
            return false;
        }
    }

}
?>