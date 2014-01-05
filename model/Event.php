<?php

class Event {
    
    /* Variabeln definieren */
    private $id;
    private $name;
    private $date;
    private $location;
    private $host;
    private $duration;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($name, $date, $location, $host, $duration) {
        $this->name = $name;
        $this->date = $date;
        $this->location = $location;
        $this->host = $host;
        $this->duration = $duration;
        
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
    //Holt Event Host
    public function getHost() {
        return $this->host;
    }
    //Setzt Event Host
    public function setHost($host) {
        $this->host = $host;
    }
    //Holt Event Dauer
    public function getDuration() {
        return $this->duration;
    }
    //Setzt Event Dauer
    public function setDuration($duration) {
        $this->duration = $duration;
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
