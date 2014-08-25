<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Andrew
 */

namespace App\Games\Blackjack;

class State {

	protected $rules = Array(
	    "decks" => 6,
	    "minBet" => 5,
	    "maxBet" => 50,
	    "blackjackPayout" => 2.5,
	    "insurancePayout" => 3,
	    "hitSplitAces" => false,
	    "resplitAces" => true,
	    "doubleAny2" => true,
	    "doubleAfterSplit" => true,
	    "dealerPeek" => true,
	    "dealerHitSoft17" => false,
	    "allowedSplits" => 3
	);

    public $player = Array();
    public $dealer;
    public $handInPlay;
    
    function __construct($state) {
        $this->dealer = $state->dealer;
        $this->player = $state->player;
        $this->handInPlay = $state->handInPlay;
        $this->gameId = $state->gameId;
    }
}
