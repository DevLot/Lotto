<?php

class Registration {
    /* Define properties */

    private $id;
    private $player;
    private $event;
    private $create_on;
    private $update_on;

    /* Constructor with parameters */

    function __construct($id, $player, $event) {
        $this->id = $id;
        $this->player = $player;
        $this->event = $event;
    }

    //Get registrations ID
    public function getId() {
        return $this->id;
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

    //Set Event
    public function setEvent($event) {
        $this->event = $event;
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
