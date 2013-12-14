<?php

class Price {
    /* Variabeln definieren */
    private $id;
    private $name;
    private $player;
    private $event;
    private $set;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($name, $player, $event, $set) {
        $this->name = $name;
        $this->player = $player;
        $this->event = $event;
        $this->set = $set;
    }
    //Holt Preis ID
    public function getId() {
        return $this->id;
    }
    //Holt Preisname
    public function getName() {
        return $this->name;
    }
    //Setzt Preisname
    public function setName($name) {
        $this->name = $name;
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
    //Holt Serie
    public function getSet() {
        return $this->set;
    }
    //Setzt Serie
    public function setSet($set) {
        $this->set = $set;
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
