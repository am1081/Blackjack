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
 
namespace App\Games\Blackjack;
 
class Player extends Person {

    public $insurance = false;
    public $initialBet;

    function __construct($bet) {
        //initialise the bet
        $this->initialBet = $bet;
        $this->hand[0] = new Hand();
        $this->hand[0]->playerHand($bet);
    }

    public function split($hand) {
        if ($this->hand[$hand]->splitCards()) {
            
            //DEEP clone the hand object
            $this->hand[$hand+1] = unserialize(serialize($this->hand[$hand]));
            
            return true;
        }
        return false;
    }
	
	//check if the player has 2 cards that add up to 21 (split hands with a sum of 21 are not blackjack)
    public function hasBlackjack() {
        if ($this->hand[0]->getValue() == 21 && count($this->hand[0]->cards) == 2 && count($this->hand) == 1) {
            return true;
        }
        return false;
    }

    public function doubleDown($hand) {
        $this->hand[$hand]->bet = $this->initialBet * 2;
    }

}
