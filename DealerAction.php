<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DealerAction
 *
 * @author Andrew
 */
 
namespace Blackjack;

class DealerAction extends State {

    public function playHand() {
        while ($this->dealer->hand[0]->value < 17) {
            $this->hit();
        }
        //hit on soft 17?
        if ($this->rules["dealerHitSoft17"] && $this->dealer->hand[0]->hasAce() && $this->dealer->hand[0]->value == 17) {
            $this->hit();
        }
        return new EndGame($this);
    }

    private function hit() {
        $this->dealer->hit($this->shoe);
    }

}
?>