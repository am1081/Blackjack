<?php

$rules = Array(
    "decks" => 6,
    "minBet" => 5,
    "maxBet" => 50,
    "blackjackPayout" => 1.5,
    "insurancePayout" => 2,
    "hitSplitAces" => false,
    "resplitAces" => true,
    "doubleAny2" => true,
    "doubleAfterSplit" => true,
    "dealerPeek" => true,
    "dealerHitSoft17" => false,
    "allowedSplits" => 3
);

class NewGame extends State {

    function __construct($bet) {
        if ($bet >= $rules["minBet"] && $bet <= $rules["maxBet"]) {
            $this->dealer = new dealer();
            $this->player = new player($bet);
            $this->handInPlay = 0;
        }
    }

    public function begin() {
        if ($this->dealer->checkAce()) {
            return new Insurance($this);
        } elseif ($this->player->checkBlackjack()) {
            return new EndGame($this);
        } else {
            return new PlayerAction($this);
        }
    }

}
