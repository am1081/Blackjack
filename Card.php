<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Card
 *
 * @author Andrew
 */


namespace Blackjack;

class Card {
	
    private $cards = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");
    public $name;
    public $value;
    
    function __construct() {
    	//we can choose the cards using the card array
    	if(isset($_SESSION['cardOrder']))
    	{
	    	$randomNo = array_pop($_SESSION['cardOrder']);
    	}
    	else
    	{
	        $randomNo = rand(0, 12);
		}
		$this->name = $this->cards[$randomNo];
		//if the card is a 10 or higher
        if ($randomNo > 8) {
            $this->value = 10;
        } else {
			//plus 1 because first card in array is an A
            if ($this->name != "A") {
                $this->value = $randomNo + 1;
            } else {
                $this->value = 11;
            }
        }
        
    }
}
?>