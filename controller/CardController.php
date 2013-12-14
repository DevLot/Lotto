<?php

include_once 'config/config.php';
include_once 'model/Card.php';
include_once 'model/Player.php';
include_once 'lib/MySqlAdapter.php';

class CardController {
    
    private $mysqlAdapter;
    
    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    
    function getLine1() {
       $list = $this->mysqlAdapter->getCard();
       
       return $list; 
    }
    function createPlayer($player) {
        
        $firstname = $player->getFirstname();
        $surname = $player->getSurname();
        $birthdate = $player->getBirthdate();
        $address = $player->getAddress();
        $zipcode = $player->getZipcode();
        $city = $player->getCity();
        $phone = $player->getPhone();
        $mobile = $player->getMobile();
        $mail = $player->getMail();
        
        $this->mysqlAdapter->createPlayer($firstname,$surname,$birthdate,$address,$zipcode,$city,$phone,$mobile,$mail);
    }

}

