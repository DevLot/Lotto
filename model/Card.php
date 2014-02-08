<?php

class Card {
    
    /* Variabeln definieren */
    private $id;
    private $cardnr;
//    private $line1=array();
//    private $line2=array();
//    private $line3=array();
    private $line1;
    private $line2;
    private $line3;
    private $player;
    private $status;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($id, $cardnr, $line1, $line2, $line3, $player, $status) {
        if (isset($id)) { $this->id = $id; }
        $this->cardnr = $cardnr;
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->line3 = $line3;
        $this->player = $player;
        $this->status = $status;
        
    }
    //Holt Karten ID
    public function getId() {
        return $this->id;
    }
    
    
    //Holt KartenNr.
    public function getCardnr() {
        return $this->cardnr;
    }
    //Setzt KartenNr.
    public function setCardnr($cardnr) {
        $this->cardnr = $cardnr;
    }
    //Holt 1. Reihe
    public function getLine1() {
        return $this->line1;
    }
    //Setzt 1. Reihe
    public function setLine1($line1/*,$nr*/) {
        $this->line1 = $line1;
    }
    //Holt 2. Reihe
    public function getLine2() {
        return $this->line2;
    }
    //Setzt 2. Reihe
    public function setLine2($line2) {
        $this->birthdate = $line2;
    }
    //Holt 3. Reihe
    public function getLine3() {
        return $this->line3;
    }
    //Setzt 3. Reihe
    public function setLine3($line3) {
        $this->line3 = $line3;
    }
    //Holt Player
    public function getPlayer() {
        return $this->player;
    }
     //Holt Status
    public function getStatus() {
        return $this->status;
    }
    //Setzt Player
    public function setPlayer($player) {
        $this->player = $player;
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
