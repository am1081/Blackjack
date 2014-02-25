<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Person
 *
 * @author Andrew
 */
class Person {

    private $hand = Array();
    
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

class Dealer extends Person {

    function __construct() {
        $this->hand = new Hand();
        $this->hand->dealerHand();
    }

    public function hasBlackjack() {
        if ($this->hand->getValue() == 21) {
            return true;
        }
        return false;
    }

    public function hasAce() {
        if ($this->hand->getValue() == 11) {
            return true;
        }
        return false;
    }

}

class Player extends Person {

    public $insurance = false;
    public $initialBet;

    function __construct($bet) {
        //initialise the bet
        $this->initialBet = $bet;
        $this->hand[0]->playerHand($bet);
        //get 2 cards
        hit();
        hit();
    }
    
    public function split($hand){
        $this->hand[$hand]->splitCards();
        //duplicate the hand
        array_push($this->hand, $this->hand[$hand]);
    }

    public function hasBlackjack() {
        if ($this->hand[0]->getValue() == 21) {
            return true;
        }
        return false;
    }

    public function doubleDown($hand) {
        $this->hand[$hand]->bet = $bet * 2;
        hit($hand);
    }

    public function insurance($insurance) {
        $this->insurance = $insurance;
    }

}
