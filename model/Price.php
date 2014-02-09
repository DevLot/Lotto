<?php

class Price {
    /* Define properties */

    private $id;
    private $name;
    private $player;
    private $event;
    private $round;
    private $line;
    private $card;
    private $create_on;
    private $update_on;

    /* Constructor with parameters */

    function __construct($id, $name, $player, $event, $round, $line, $card) {
        if (isset($id)) {
            $this->id = $id;
        }
        $this->name = $name;
        $this->player = $player;
        $this->event = $event;
        $this->round = $round;
        $this->line = $line;
        $this->card = $card;
    }

    //
    public function getId() {
        return $this->id;
    }

    //Get price name
    public function getName() {
        return $this->name;
    }

    //Set price name
    public function setName($name) {
        $this->name = $name;
    }

    //Get player
    public function getPlayer() {
        return $this->player;
    }

    //Set player
    public function setPlayer($player) {
        $this->player = $player;
    }

    //Get event
    public function getEvent() {
        return $this->event;
    }

    //Set event
    public function setEvent($event) {
        $this->event = $event;
    }

    //Get round
    public function getRound() {
        return $this->round;
    }

    //Set round
    public function setSet($round) {
        $this->round = $round;
    }

    //Get line
    public function getLine() {
        return $this->line;
    }

    //Get card number
    public function getCard() {
        return $this->card;
    }

    //Set line
    public function setLine($line) {
        $this->line = $line;
    }

    //Get create date
    public function getCreateOn() {
        return $this->create_on;
    }

    //Get update date
    public function getUpdateOn() {
        return $this->update_on;
    }

}
