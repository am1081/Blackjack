<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Andrew
 */
class State {
    
    public $player = Array();
    public $dealer;
    public $handInPlay;
    
    function __construct($state) {
        $this->dealer = $state->dealer;
        $this->player = $state->player;
        $this->handInPlay = $state->handInPlay;
    }
    
}
