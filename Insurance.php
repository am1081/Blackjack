<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Insurance
 *
 * @author Andrew
 */
class Insurance {

    function __construct($state) {
        $this->dealer = $state->dealer;
        $this->player = $state->player;
        $this->handInPlay = $state->handInPlay;
    }

    public function takeInsurance($insurance) {
        $this->player->insurance($insurance);
        //if player has blackjack or peek is enabled then move to the end state
        if (($this->plyer->checkBlackjack()) || $rules["dealerPeek"]) {
            return new EndGame($this);
        } else {
            return new PlayerAction($this);
        }
    }

}
