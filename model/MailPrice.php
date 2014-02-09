<?php

class MailPrice {
    /* Define properties */

    private $name;
    private $firstname;
    private $mail;

    /* Constructor with parameters */

    function __construct($name, $firstname, $mail) {

        $this->name = $name;
        $this->firstname = $firstname;
        $this->mail = $mail;
    }

    //Get pricename
    public function getName() {
        $this->name = $name;
    }

    //Get firstname of winner
    public function getFirstname() {
        $this->firstname = $firstname;
    }

    //Get mailaddress
    public function getMail() {
        $this->mail = $mail;
    }

}
