<?php

class Event {
    /* Define properties */

    private $id;
    private $name;
    private $date;
    private $location;
    private $organizer;
    private $duration;
    private $players = array();
    private $create_on;
    private $update_on;

    /* Constructor with parameters */

    function __construct($id, $name, $date, $location, $organizer) {

        if (isset($id)) {
            $this->id = $id;
        }
        $this->name = $name;
        $this->date = $date;
        $this->location = $location;
        $this->organizer = $organizer;
    }

    //Get card ID
    public function getId() {
        return $this->id;
    }

    //Get eventname
    public function getName() {
        return $this->name;
    }

    //Set eventname
    public function setName($name) {
        $this->name = $name;
    }

    //Get date
    public function getDate() {
        return $this->date;
    }

    //Set date
    public function setDate($date) {
        $this->date = $date;
    }

    //Get location
    public function getLocation() {
        return $this->location;
    }

    //Set eventlocation
    public function setLocation($location) {
        $this->location = $location;
    }

    //Get organizer
    public function getOrganizer() {
        return $this->organizer;
    }

    //Set organizer
    public function setOrganizer($organizer) {
        $this->organizer = $organizer;
    }

    //Get duration
    public function getDuration() {
        return $this->duration;
    }

    //Set duration
    public function setDuration($duration) {
        $this->duration = $duration;
    }

    //Get all players of this game
    public function getPlayers() {
        return $this->players;
    }

    //Set all Players of this game
    public function setPlayers($players) {
        $this->players = $players;
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
