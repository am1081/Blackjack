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

    public $name;
    public $value;
    
    function __construct($name,$value)
    {
	    $this->name = $name;
	    $this->value = $value;
    }
  
}
?>