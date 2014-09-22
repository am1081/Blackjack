<?php 

namespace Blackjack;

class Person {

    public $hand = Array();
    
    public function hit($shoe,$hand = 0)
    {
        $this->hand[$hand]->addCard($shoe);
    }
    
    public function isBust($hand = 0)
    {
        if($this->hand[$hand]->value > 21){
            return true;
        } else {
            return false;
        }
    }

}
?>