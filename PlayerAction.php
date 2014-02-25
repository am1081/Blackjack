<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlayerAction
 *
 * @author Andrew
 */
class PlayerAction extends State {

    public function hit() {
        $this->player->hit($this->handInPlay);
        if ($this->player->isBust($this->handInPlay)) {
            if ($this->handInPlay < count($this->player->hand)) {
                $this->handInPlay++;
            } else {
                return new DealerAction($this);
            }
        }
        return $this;
    }

    public function split() {
        //don't allow more splits than the maximum and check split returns true
        if ((count($this->player->hand) < $rules["allowedSplits"]) && $this->player->split($this->handInPlay)) {
            
            $this->player->split($this->handInPlay);
            //make this hand the current one in play
            $this->handInPlay++;
            return hit();
        }
        return $this;
    }

    public function double() {
        //if DAS is disabled then the player can only double if they are playing one hand (not split)
        if ($rules["doubleAfterSplit"] ||  count($this->player->hand) == 1) {
            $this->player->doubleDown($this->handInPlay);
            //if this is the last hand they have to play then move onto the dealer
            if ($this->handInPlay == 0) {
                return new DealerAction($this);
            } else {
                $this->handInPlay--;
                return $this;
            }
        }
        return $this;
    }

}
