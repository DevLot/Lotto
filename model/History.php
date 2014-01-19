<?php

class History {
    
    /* Variabeln definieren */
    private $id;
    private $event;
    private $round;
    private $numbers;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($id, $event, $round, $numbers, $create_on, $update_on) {
        $this->id = $id;
        $this->event = $event;
        $this->round = $round;
        $this->numbers = $numbers;
        $this->create_on = $create_on;
        $this->update_on = $update_on;
        
    }
    //Holt Karten ID
    public function getId() {
        return $this->id;
    }
    //Holt Event
    public function getEvent() {
        return $this->event;
    }
    //Setzt Event
    public function setEvent($event) {
        $this->event = $event;
    }
    //Holt Set(Serie)
    public function getRound() {
        return $this->round;
    }
    //Setzt Set(Serie)
    public function setRound($round) {
        $this->set = $round;
    }
    //Holt Nummern
    public function getNumbers() {
        return $this->numbers;
    }
    //Setzt Nummern
    public function setNumbers($numbers) {
        $this->numbers = $numbers;
    }
    //Holt Erstell Datum/Zeit
    public function getCreateOn() {
        return $this->create_on;
    }
    //Holt Aktuallisierungs Datum/Zeit
    public function getUpdateOn() {
        return $this->update_on;
    }
}
