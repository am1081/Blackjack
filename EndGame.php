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
class EndGame extends State {

    public $take;

    public function calculateReturn() {

        $initialBet = $this->player->initialBet;
        $dealerHandValue;

        if ($this->dealer->hasBlackjack()) {
            if ($this->player->hasBlackjack()) {
                $take += $initialBet; //blackjack
            }
            if ($this->player->insurance) {
                $take += ($initialBet / 2) * $rules["insurancePay"]; //insurance   
            }
            return $this;
        }

        if ($this->player->hasBlackjack()) {
            $take += $initialBet * $rules["blackjackPay"]; //blackjack
            return $this;
        }
        
        $dealerHandValue = $this->dealer->hand[0]->getValue();

        foreach ($this->player->hand as $hand) {
            if (!$hand->isBust()) {
                if ($hand->getValue() > $dealerHandValue) {
                    $take += $hand->bet*2;
                } else if($hand->getValue() == $dealerHandValue) {
                    $take += $hand->bet;
                }
            }
        }
        return $this;
    }
}
