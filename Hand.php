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

namespace Blackjack;

class Hand {

    public $cards = Array();
    public $bet = 0;
    public $value = 0;

    //dealer hand
    public function dealerHand($shoe){
        $this->addCard($shoe);
        $this->addCard($shoe);
    }
    //player hand
    public function playerHand($bet,$shoe){
        $this->bet = $bet;
        $this->addCard($shoe);
        $this->addCard($shoe);
    }
    
    public function addCard($shoe) {
        $newCard = $shoe->getCard();
        array_push($this->cards, $newCard);
        $this->value = $this->getValue();
    }

    public function isBust() 
    {
        if ($this->getValue() > 21) {
            return true;
        }
        return false;
    }
    
    public function hasAce()
    {
	    foreach($this->cards as $card)
	    {
		    if($card->value == 11)
		    {
			    return true;
		    }
	    }
	    return false;
    }

    public function double() 
    {
        $this->bet = $this->bet * 2;
    }

	//checks the cards are the same and if so, removes one.
    public function splitCards() 
    {
        //if the cards are the same
        if ($this->cards[0]->value == $this->cards[1]->value) {
            return true;
        } else {
            return false;
        }
    }
    
    public function isBlackjack()
    {
	    if($this->getValue() == 21 && count($this->cards) == 2)
	    {
		    return true;
	    }
	    else
	    {
		    return false;
	    }
    }
    
    public function getValue() {
        $value = 0;
        $aces = 0;
        
        foreach ($this->cards as $card)
        {
        	$value += $card->value;
        	if($card->value == 11)
        	{
        		$aces++;
        	}
        }
        
        //if the total is over 21 and we have aces, we need to convert them to 1
        while($value > 21 && $aces-- > 0)
        {
	        $value -= 10;
        }
        
        return $value;
    }
    
    public function getCards() {
        $cards = Array();
        foreach ($this->cards as $card) {
            array_push($cards,$card->name);
        }
        return $cards;
    }
}
?>