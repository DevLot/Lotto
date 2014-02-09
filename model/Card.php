<?php

class Card {
    /* Define properties */

    private $id;
    private $cardnr;
    private $line1;
    private $line2;
    private $line3;
    private $player;
    private $status;
    private $create_on;
    private $update_on;

    /* Constructor with parameters */

    function __construct($id, $cardnr, $line1, $line2, $line3, $player, $status) {
        if (isset($id)) {
            $this->id = $id;
        }
        $this->cardnr = $cardnr;
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->line3 = $line3;
        $this->player = $player;
        $this->status = $status;
    }

    //Get card id
    public function getId() {
        return $this->id;
    }

    //Get Card number
    public function getCardnr() {
        return $this->cardnr;
    }

    //Set Cardnr
    public function setCardnr($cardnr) {
        $this->cardnr = $cardnr;
    }

    //Get line 1
    public function getLine1() {
        return $this->line1;
    }

    //Set line 1
    public function setLine1($line1/* ,$nr */) {
        $this->line1 = $line1;
    }

    //Get line 2
    public function getLine2() {
        return $this->line2;
    }

    //Set line 2
    public function setLine2($line2) {
        $this->birthdate = $line2;
    }

    //Get line 3
    public function getLine3() {
        return $this->line3;
    }

    //Set line 4
    public function setLine3($line3) {
        $this->line3 = $line3;
    }

    //Get player
    public function getPlayer() {
        return $this->player;
    }

    //Get status
    public function getStatus() {
        return $this->status;
    }

    //Set player
    public function setPlayer($player) {
        $this->player = $player;
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
