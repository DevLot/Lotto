<?php

class Event {
    
    /* Variabeln definieren */
    private $id;
    private $name;
    private $date;
    private $location;
    private $organizer;
    private $duration;
    private $players = array();
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
   function __construct($id, $name, $date, $location, $organizer) {
        
        if (isset($id)) { $this->id = $id; }
        $this->name = $name;
        $this->date = $date;
        $this->location = $location;
        $this->organizer = $organizer; 
        //$this->duration = $duration;
        //$this->players = $players;
        
    }
    //Holt Karten ID
    public function getId() {
        return $this->id;
    }  
   
    //Holt Event Name
    public function getName() {
        return $this->name;
    }
    //Setzt Event Name
    public function setName($name) {
        $this->name = $name;
    }
    //Holt Event Datum
    public function getDate() {
        return $this->date;
    }
    //Setzt Event Datum
    public function setDate($date) {
        $this->date = $date;
    }
    //Holt Event Ort
    public function getLocation() {
        return $this->location;
    }
    //Setzt Event Ort
    public function setLocation($location) {
        $this->location = $location;
    }
    //Holt Eventveranstalter
    public function getOrganizer() {
        return $this->organizer;
    }
    //Setzt Eventveranstalter
    public function setOrganizer($organizer) {
        $this->organizer = $organizer;
    }
    //Holt Event Dauer
    public function getDuration() {
        return $this->duration;
    }
    //Setzt Event Dauer
    public function setDuration($duration) {
        $this->duration = $duration;
    }
    public function getPlayers() {
        return $this->players;
    }
    public function setPlayers($players) {
        $this->players = $players;
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
