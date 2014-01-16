<?php

class Registration {
    
    /* Variabeln definieren */
    private $id;
    private $player;
    private $event;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($player, $event) {
        $this->player = $player;
        $this->event = $event;
        
    }
    //Holt Registrations ID
    public function getId() {
        return $this->id;
    }
    //Holt Player
    public function getPlayer() {
        return $this->player;
    }
    //Setzt Player
    public function setPlayer($player) {
        $this->player = $player;
    }
    //Holt Event
    public function getEvent() {
        return $this->event;
    }
    //Setzt Event
    public function setEvent($event) {
        $this->event = $event;
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
