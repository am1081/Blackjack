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
    	echo count($this->player->hand);
    	echo $this->handInPlay;
        $this->player->hit($this->handInPlay);
        if ($this->player->isBust($this->handInPlay)) {
            if ($this->handInPlay > 0) { //if this isn't the last hand
                $this->handInPlay--;
                $this->hit();
            } else {
                return new EndGame($this);
            }
        }
        return $this;
    }

    public function split() {
        //don't allow more splits than the maximum and check split returns true
        if (count($this->player->hand[$this->handInPlay]->cards) == 2 && (count($this->player->hand) <= $this->rules["allowedSplits"]) && $this->player->split($this->handInPlay)) {
            //make this hand the current one in play
            $this->handInPlay++;
            return $this->hit();
        }
        return $this;
    }

    public function double() {
        //if DAS is disabled then the player can only double if they are playing one hand (not split). Also checks the hand size is currently 2
        if (($this->rules["doubleAfterSplit"] ||  count($this->player->hand) == 1) && count($this->player->hand[$this->handInPlay]->cards) == 2 ) {
            $this->player->doubleDown($this->handInPlay);
            
            //hit
            $this->hit();
            
            //now stick
            return $this->stick();
        }
        //if you can't double
        return $this;
    }
    
    public function stick() {
        //if DAS is disabled then the player can only double if they are playing one hand (not split)
        if ($this->handInPlay == 0) {
                return new DealerAction($this);
            } else { //when the hand has been split
                $this->handInPlay--;
                $this->hit();
                return $this;
            }
        }
    }
