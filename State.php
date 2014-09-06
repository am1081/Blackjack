<?php

namespace Blackjack;

class State {

	protected $rules = Array(
	    "decks" => 6,
	    "minBet" => 5,
	    "maxBet" => 500,
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
    }
}

?>