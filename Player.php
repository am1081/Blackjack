<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Player
 *
 * @author Andrew
 */
 
namespace Blackjack;
 
class Player extends Person {

    public $insurance = false;
    public $initialBet;

    function __construct($bet,$shoe) {
        //initialise the bet
        $this->initialBet = $bet;
        $this->hand[0] = new Hand();
        $this->hand[0]->playerHand($bet,$shoe);
    }

    public function split($hand) {
        if ($this->hand[$hand]->splitCards()) {
            
            $newHand = new Hand();
            
            //add the second card in the current hand to the new hand
            $newHand->cards[0] = $this->hand[$hand]->cards[1];
            
            //remove the card from the current hand
            array_pop($this->hand[$hand]->cards);
            
            
            //Insert the new hand into the array of current player hands
            array_splice($this->hand,$hand+1,0,array($newHand));
            
            
            
            return true;
        }
        return false;
    }
	
	//check if the player has 2 cards that add up to 21 (split hands with a sum of 21 are not blackjack)
    public function hasBlackjack() {
        if ($this->hand[0]->value == 21 && count($this->hand[0]->cards) == 2 && count($this->hand) == 1) {
            return true;
        }
        return false;
    }

    public function doubleDown($hand) {
        $this->hand[$hand]->bet = $this->initialBet * 2;
    }

}
?>