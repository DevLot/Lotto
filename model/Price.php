<?php

class Price {
    /* Variabeln definieren */
    private $id;
    private $name;
    private $player;
    private $event;
    private $round;
    private $line;
    private $card;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($id, $name, $player, $event, $round, $line, $card) {
        if (isset($id)) { $this->id = $id; }
        $this->name = $name;
        $this->player = $player;
        $this->event = $event;
        $this->round = $round;
        $this->line = $line;
         $this->card = $card;
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
    public function getRound() {
        return $this->round;
    }
    //Setzt Serie
    public function setSet($round) {
        $this->round = $round;
    }
        //Holt Serie
    public function getLine() {
        return $this->line;
    }
    
          //Holt Kartennummer
    public function getCard() {
        return $this->card;
    }
    //Setzt Serie
    public function setLine($line) {
        $this->line = $line;
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
