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

class Shoe {

    private $cards = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");
    private $suits = array("s","h","d","c");
    private $deck = array();
    
    function __construct($noOfDecks) {
    	//if we want multiple decks of cards in the shoe
    	for($i = $noOfDecks; $i > 0; $i--)
    	{
    		//for each card name
	    	for($j = count($this->cards)-1; $j >= 0; $j--)
	    	{
	    		//for each suit
		    	foreach($this->suits as $suit)
		    	{
		    		
		    		$name = $this->cards[$j].$suit;
		    		$value = null;
		    	    		
	    		  	if ($j > 8) {
			            $value = 10;
			        } else {
						//plus 1 because first card in array is an A
			            if ($j > 0) {
			                $value = $j + 1;
			            } else {
			                $value = 11;
			            }
			        }
			        //add the new card to the deck		        
			    	array_push($this->deck,new Card($name,$value));
		    	}
	    	}
    	}
    }
    
    //shuffle and slice the deck. We don't need to store all the cards, only the first 28 for blackjack.
    public function shuffle($slice = null)
    {

		// shuffle using Fisher-Yates
		$i = count($this->deck);
		
		while(--$i){
			$j = mt_rand(0,$i);
			if($i != $j){
				// swap items
				$tmp = $this->deck[$j];
				$this->deck[$j] = $this->deck[$i];
				$this->deck[$i] = $tmp;
			}
		}
		
		if(!is_null($slice))
		{
			$this->deck = array_slice($this->deck,0,$slice);
		}
		
		//test deck
		//$this->deck = array(new Card("a",10),new Card("b",10),new Card("c",10),new Card("d",10),new Card("e",10),new Card("f",10),new Card("g",10),new Card("K",10));

    }
    
    public function testDistribution()
    {
    	
    	//test code
    	$counts = array();
		
		for($i = 0; $i<100000; $i++)
		{
			$this->shuffle();
			if(!isset($counts[$this->deck[0]->name]))
			{
				$counts[$this->deck[0]->name] = 0;
			}
			$counts[$this->deck[0]->name] += 1;
		}
		
		
		echo json_encode($counts,JSON_PRETTY_PRINT);
		die();
    }
    
    public function getCard() {
    	return array_pop($this->deck);
    }
    
}
?>