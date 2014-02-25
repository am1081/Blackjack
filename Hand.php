<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hand
 *
 * @author Andrew
 */
class Card {

    private $cards = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");
    public $name;
    public $value;

    function __construct() {
        $randomNo = rand(0, 12);
        $name = $cards[$randomNo];

//if the card is a 10 or higher
        if ($randomNo > 8) {
            $value = 10;
        } else {
//plus 1 because first card in array is an A
            if ($name != "A") {
                $value = $randomNo + 1;
            } else {
                $value = 11;
            }
        }
    }

}

class Hand {

    private $cards = Array();
    private $value = 0;
    public $bet = 0;
    public $hasAce = false;

    //dealer hand
    public function dealerHand(){
        $this->hand->addCard();
    }
    //player hand
    public function playerHand($bet){
        $this->hand->addCard();
        $this->hand->addCard();
    }
    public function hit() {
        $newCard = new Card();
        if ($newCard->value = 1) {
            $this->hasAce = true;
        }
        array_push($this->cards, new Card());
    }

    public function isBust() {
        if ($this->value > 21) {
            return true;
        }
        return false;
    }

    public function double() {
        $this->bet = $this->bet * 2;
    }

    public function splitCards() {
        //if the cards are the same
        if ($this->cards[0]->name = $this->cards[1]->name) {
            //remove one card
            array_pop($this->cards);
            return true;
        } else {
            return false;
        }
    }

    public function getValue() {
        $value = 0;
        foreach ($this->cards as $card) {
            if ($value > 11 || $card->value != 1) {
                $value += $card->value;
            } else {
                $value += 11;
            }
        }
        if($value > 21){
            $value = 0;
        }
        return $value;
    }

}
