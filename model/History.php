<?php

class History {
    /* Define properties */

    private $id;
    private $event;
    private $round;
    private $numbers;
    private $create_on;
    private $update_on;

    /* Constructor with parameters */

    function __construct($id, $event, $round, $numbers, $create_on, $update_on) {
        if (isset($id)) {
            $this->id = $id;
        }
        $this->event = $event;
        $this->round = $round;
        $this->numbers = $numbers;
        $this->create_on = $create_on;
        $this->update_on = $update_on;
    }

    //Get card id
    public function getId() {
        return $this->id;
    }

    //Get event 
    public function getEvent() {
        return $this->event;
    }

    //Set event
    public function setEvent($event) {
        $this->event = $event;
    }

    //Get set(Serie)
    public function getRound() {
        return $this->round;
    }

    //Set set(Serie)
    public function setRound($round) {
        $this->set = $round;
    }

    //Get numbers
    public function getNumbers() {
        return $this->numbers;
    }

    //Set Nummerns
    public function setNumbers($numbers) {
        $this->numbers = $numbers;
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
