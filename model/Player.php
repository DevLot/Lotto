<?php

class Player {
    /* Define properties */

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
    private $status;
    private $create_on;
    private $update_on;

    /* Constructor with parameters */

    function __construct($id, $firstname, $surname, $birthdate, $address, $zipcode, $city, $phone, $mobile, $mail) {
        if (isset($id)) {
            $this->id = $id;
        }
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->phone = $phone;
        $this->mobile = $mobile;
        $this->mail = $mail;
        $this->create_on = date("Y-m-d H:i:s");
        $this->update_on = date("Y-m-d H:i:s");
    }

    //Get player id
    public function getId() {
        return $this->id;
    }

    //Get firstname
    public function getFirstname() {
        return $this->firstname;
    }

    //Set firstname
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    //Get surname
    public function getSurname() {
        return $this->surname;
    }

    //Set surname
    public function setSurname($surname) {
        $this->surname = $surname;
    }

    //Get birthdate
    public function getBirthdate() {
        return $this->birthdate;
    }

    //Set birthdate
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    //Get address
    public function getAddress() {
        return $this->address;
    }

    //Set address
    public function setAddress($address) {
        $this->address = $address;
    }

    //Get zipcode
    public function getZipcode() {
        return $this->zipcode;
    }

    //Set zipcode
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }

    //Get city
    public function getCity() {
        return $this->city;
    }

    //Set city
    public function setCity($city) {
        $this->city = $city;
    }

    //Get phone number
    public function getPhone() {
        return $this->phone;
    }

    //Set phone number
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    //Get mobile number
    public function getMobile() {
        return $this->mobile;
    }

    //Get mobile number
    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    //Get mail
    public function getMail() {
        return $this->mail;
    }

    //Set mail
    public function setMail($mail) {
        $this->mail = $mail;
    }

    //Get status
    public function getStatus() {
        return $this->status;
    }

    //Set player
    public function setStatus($status) {
        $this->status = $status;
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
