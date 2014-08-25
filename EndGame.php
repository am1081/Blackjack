<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Final
 *
 * @author Andrew
 */

namespace App\Games\Blackjack;

class EndGame extends State {

    public $take = 0;

    public function calculateReturn() {

        $initialBet = $this->player->initialBet;
        $dealerHandValue;

        if ($this->dealer->hasBlackjack()) {
            if ($this->player->hasBlackjack()) {
                $this->take += $initialBet; //blackjack
            }
            if ($this->player->insurance) {
                $this->take += ($initialBet / 2) * $this->rules["insurancePayout"]; //insurance   
            }
            return $this;
        }

        if ($this->player->hasBlackjack()) {
            $this->take += $initialBet * $this->rules["blackjackPayout"]; //blackjack
            return $this;
        }
        
        $dealerHandValue = $this->dealer->hand[0]->getValue();
		
        foreach ($this->player->hand as $hand) {
            if (!$hand->isBust()) {
                
                if ($hand->getValue() > $dealerHandValue || $this->dealer->isBust()) {
                    $this->take += $hand->bet*2;
                } else if($hand->getValue() == $dealerHandValue) {
                    $this->take += $hand->bet;
                }
            }
        }
        return $this;
    }
}
