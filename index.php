<?php

class BlackjackGame {

    private $cards = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");
    private $state;
    private $player;
    private $dealer;

    function __construct($state, $action) {
        switch ($state->mode) {
            case null:
                $dealer = new dealer();
                $player = new player();
                //check for dealer ace (insurance)

                return new state(new Player(), new Dealer(), "begin")
                break;
            case "player":
                new PlayerAction($state, $action);
                break;
            case "dealer":
                new DealerAction($state, $action);
                break;
        }

        $this->state = $state;



        return $state;
    }

    function begin() {
        if ($dealer->hand->getValue() == 11) {
            $state->mode = "insurance";
            return $state;
        }
        //check for player blackjack
        if ($player->hand->getValue() == 21) {
            return new Finish($state);
        }
    }

}

class state {

    public $mode;
    //treat a split like creating a new player
    public $player = Array();
    public $dealer;
    public $handInPlay = 0;

    function __construct($player, $dealer, $mode) {
        $this->dealer = $dealer;
        array_push($this->$player, $player);
        $this->mode = $mode;
    }

}

class PlayerAction extends state {

    private $player;

    function __construct($state, $action) {
        switch ($action) {
            case "hit":
                //multipl
                $currentPlayer = $state->player[$state->handInPlay]->hit();
                $currentPlayer->hit();
                if ($currentPlayer->hand->IsBust()) {
                    $state->handInPlay++;
                }
                if ($hand)
                    return new state ($player, $state->dealer, "input")
                break;
            case "stick":
                return new DealerAction($state)
        }
    }

    private function split() {
        $state->pla PlayerAction($player);
    }

}

class DealerAction {

    private $dealer;

    function __construct($state) {
        switch ($action) {
            case "hit":
                //multipl
                $currentPlayer = $state->player[$state->handInPlay]->hit();
                $currentPlayer->hit();
                if ($currentPlayer->hand->IsBust()) {
                    $state->handInPlay++;
                }
                if ($hand)
                    return new state ($player, $state->dealer, "input")
                break;
            case "stick":
                return new DealerAction()
        }
    }

}

class Finish {
    function __construct($state) {
        
    }
}

class Card {

    public $name;
    public $value;

    function __construct() {
        $randomNo = rand(0, 12);
        $name = $cards[$randomNo];

        //if the card is a 10 or higher
        if ($randomNo > 8) {
            $value = 10;
        } else {
            //plus 1 because first card in array is an A
            if ($name != "A") {
                $value = $randomNo + 1;
            } else {
                $value = 11;
            }
        }
    }

}

class Hand {

    private $cards = Array();
    private $value = 0;

    public function addCard() {
        array_push($cards, new Card());
    }

    public function isBust() {
        if ($value > 21) {
            return true;
        }
        return false;
    }

    public function getValue() {
        $value = 0;
        foreach ($cards as $card) {
            if ($value > 11 || $card->value != 1) {
                $value += $card->value;
            } else {
                $value += 11;
            }
        }
        return $value;
    }

}

class Person {

    private $hand;

    private function hit() {
        $hand->addCard();
        return $this;
    }

}

class Dealer extends Person {

    function __construct() {
        //get 2 cards
        hit();
        //check for ace
        if ($hand->getValue() == 11) {
            //offer insurance
        }
    }

}

class Player extends Person {

    function __construct() {
        //get 2 cards
        hit();
        hit();
        //check for blackjack
        if ($this->getScore() == 21) {
            //blackjack
        }
    }

    public function doubleDown() {
        
    }

    public function insurance() {
        $blackjack
    }

    public function split() {
        
    }

}

?>