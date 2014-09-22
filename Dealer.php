<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dealer
 *
 * @author Andrew
 */
 
namespace Blackjack;
 
class Dealer extends Person {

    function __construct($shoe) {
        $this->hand[0] = new Hand();
        $this->hand[0]->dealerHand($shoe);
    }

    public function hasBlackjack() {
        if ($this->hand[0]->getValue() == 21 && count($this->hand[0]->cards) == 2) {
            return true;
        }
        return false;
    }

    public function showsAce() {
        if ($this->hand[0]->cards[0]->value == 11) {
            return true;
        }
        return false;
    }

}
?>
