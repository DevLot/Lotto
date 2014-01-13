<?php

class Player {
    
    /* Variabeln definieren */
    private $id;
    private $firstname;
    private $surname;
    private $birthdate;
    private $address;
    private $zipcode;
    private $city;
    private $phone;
    private $mobile;
    private $mail;
    private $create_on;
    private $update_on;
    
    /* Konstruktor mit Übergabeparameter */
    function __construct($id, $firstname, $surname, $birthdate, $address, $zipcode, $city, $phone, $mobile, $mail) {
        
        if (isset($id)) { $this->id = $id; }
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->phone = $phone;
        $this->mobile = $mobile;
        $this->mail = $mail;
        
    }
    //Holt Player ID
    public function getId() {
        return $this->id;
    }
    //Holt Vornahme
    public function getFirstname() {
        return $this->firstname;
    }
    //Setzt Vornahme
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    //Holt Nachnamen
    public function getSurname() {
        return $this->surname;
    }
    //Setzt Nachnamen
    public function setSurname($surname) {
        $this->surname = $surname;
    }
    //Holt Geburtsdatum
    public function getBirthdate() {
        return $this->birthdate;
    }
    //Setzt Geburtsdatum
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }
    //Holt Adresse
    public function getAddress() {
        return $this->address;
    }
    //Setzt Adresse
    public function setAddress($address) {
        $this->address = $address;
    }
    //Holt PLZ
    public function getZipcode() {
        return $this->zipcode;
    }
    //Setzt PLZ
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }
    //Holt Ort
    public function getCity() {
        return $this->city;
    }
    //Setzt Ort
    public function setCity($city) {
        $this->city = $city;
    }
    //Holt TelefonNr.
    public function getPhone() {
        return $this->phone;
    }
    //Setzt TelefonNr.
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    //Holt MobileNr.
    public function getMobile() {
        return $this->mobile;
    }
    //Setzt MobileNr.
    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }
    //Holt E-Mail Adresse
    public function getMail() {
        return $this->mail;
    }
    //Setzt E-Mail Adresse
    public function setMail($mail) {
        $this->mail = $mail;
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