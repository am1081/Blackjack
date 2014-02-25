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
class DealerAction extends State {

    public function playHand() {
        hit();
        if ($this->dealer->checkBlackjack()) {
            return new EndGame($this);
        }
        while ($this->dealer->hand->getValue < 17) {
            hit();
        }
        //hit on soft 17?
        if ($rules["dealerHitsSoft17"] && $this->dealer->hand->hasAce() && $this->dealer->hand->getValue == 17) {
            hit();
        }
        return new EndGame($this);
    }

    private function hit() {
        $this->dealer->hand[0]->hit();
    }

}
