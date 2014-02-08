<?php

class MailPrice {
    
    /* Variabeln definieren */
    private $name;
    private $firstname;
    private $mail;

    
    /* Konstruktor mit Übergabeparameter */
    function __construct($name, $firstname, $mail) {

        $this->name = $name;
        $this->firstname = $firstname;
        $this->mail = $mail;
        
    }
        
    //Holt preisname
    public function getName() {
        $this->name = $name;
    }
    
    //Holt Vorname
    public function getFirstname() {
        $this->firstname = $firstname;
    }
   
    //Holt mailadresse
    public function getMail() {
        $this->mail = $mail;
    }
   
   
}