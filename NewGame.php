<?php

class NewGame extends State {

    function __construct($bet,$id) {
        if ($bet >= $this->rules["minBet"] && $bet <= $this->rules["maxBet"]) {
            $this->dealer = new dealer();
            $this->player = new player($bet);
            $this->handInPlay = 0;
            $this->gameId = $id;
        }
    }

    public function begin() {
        if ($this->dealer->showsAce()) {
            return new Insurance($this);
        } 
        //if the player has blackjack or the dealer has blackjack and peek is on
        elseif ($this->player->hasBlackjack() || ($this->rules["dealerPeek"] && $this->dealer->hasBlackjack())) 
        {
            return new EndGame($this);
        }
        else 
        {
            return new PlayerAction($this);
        }
    }
}
