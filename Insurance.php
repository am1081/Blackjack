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
class Insurance extends State{

    public function takeInsurance($insurance) {
        $this->player->insurance($insurance);
        //if player has blackjack or peek is enabled then move to the end state
        if ($this->player->hasBlackjack() || ($this->rules["dealerPeek"] && $this->dealer->hasBlackjack())) {
            return new EndGame($this);
        } else {
            return new PlayerAction($this);
        }
    }

}
