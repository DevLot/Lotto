<?php

class Histroy {
    
    /* Variabeln definieren */
    private $id;
    private $event;
    private $set;
    private $numbers;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($event, $set, $numbers) {
        $this->event = $event;
        $this->set = $set;
        $this->numbers = $numbers;
        
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
    public function getSet() {
        return $this->set;
    }
    //Setzt Set(Serie)
    public function setSet($set) {
        $this->set = $set;
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
