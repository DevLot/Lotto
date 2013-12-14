<?php

final class MySqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;
    private $sql;

    //Konstruktor
    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        $this->open();
    }
    //Dekonstruktor
    public function __destruct() {
        $this->close();
    }
    //Erstellt eine Verbindung zur DB
    private function open() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_errno) {
            echo 'DB Error: ' . $this->con->connect_error;
            $this->con = null;
        } else {
            $this->con->set_charset('utf8');
        }
    }
    //Schliesst Verindung zur DB
    private function close() {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }
/*Funktionen für Zugriff auf DB:
 * - getHistory()
 * - updateHistory()
 * - getCards()
 * - createCards()
 * - updateCards()
 * - getPlayers()
 * - createPlayers()
 * - updatePlayers()
 * - getEvents()
 * - createEvents()
 * - updateEvents()
 * - getPrices()
 * - createPrices()
 * - updatePrices()
 */

    //Holt History
    public function getHistory() {
    
    }
    //Aktuallisiert History
    public function updateHistory($object) {
        
    }
    //Holt Spielkarten
    public function getCard() {
        
        $res = $this->con->query("SELECT * FROM fabingo.cards WHERE id=2");
        //$res->free();
        $row = $res->fetch_object()->line1;        
        
        return $row;
    }
    //Erstellt Spielkarte
    public function createCard($cn,$l1,$l2,$l3,$pl) {
        
        $cardnr = $cn;
        $line1 = $l1;
        $line2 = $l2;
        $line3 = $l3;
        $player = $pl;
        
        $sql = "INSERT INTO cards
                (
                    cardnr,line1,line2,line3,player,create_on,update_on
                )
                VALUES
                (
                    '$cardnr','$line1','$line2','$line3','$player',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()
                    
                );
         ";
        
        $this->con->query($sql);
    }
    //Aktuallisiert Spielkarte
    public function updateCards($cn,$l1,$l2,$l3,$pl) {
        
        $cardnr = $cn;
        $line1 = $l1;
        $line2 = $l2;
        $line3 = $l3;
        $player = $pl;
        
        $sql = "UPDATE";
        
        $this->con->query($sql);
    }
    //Holt Spieler
    public function getPlayers() {
        
    }
    //Erstellt Spieler
    public function createPlayer($fn,$sn,$bd,$ad,$zc,$ci,$ph,$mo,$ma) {
        
        $firstname = $fn;
        $surname = $sn;
        $birthdate = $bd;
        $address = $ad;
        $zipcode = $zc;
        $city = $ci;
        $phone = $ph;
        $mobile = $mo;
        $mail = $ma;
        
        $sql = "INSERT INTO players
                (
                    firstname,surname,birthdate,address,zipcode,city,phone,mobile,mail,create_on,update_on
                )
                VALUES
                (
                    '$firstname','$surname','$birthdate','$address','$zipcode','$city','$phone','$mobile','$mail',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()
                    
                );
         ";
        
        $this->con->query($sql);
    }
    //Aktuallisier Spieler
    public function updatePlayer($fn,$sn,$bd,$ad,$zc,$ci,$ph,$mo,$ma) {
        
        $firstname = $fn;
        $surname = $sn;
        $birthdate = $bd;
        $address = $ad;
        $zipcode = $zc;
        $city = $ci;
        $phone = $ph;
        $mobile = $mo;
        $mail = $ma;
        
        $sql = "UPDATE";
        
        $this->con->query($sql);      
    }
    //Holt Event
    public function getEvents() {
        
    }
    //Erstellt Event
    public function createEvents($nm,$da,$lo,$ho) {
        
        $name = $nm;
        $date = $da;
        $location = $lo;
        $host = $ho;
        
        $sql = "INSERT INTO";
        
        $this->con->query($sql);
    }
    //Aktuallisiert Event
    public function updateEvents($nm,$da,$lo,$ho) {
     
        $name = $nm;
        $date = $da;
        $location = $lo;
        $host = $ho;
        
        $sql = "UPDATE";
        
        $this->con->query($sql);
    }
    //Holt Preis
    public function getPrice() {
        
    }
    //Erstellt Preis
    public function createPrice($nm,$ev,$st) {
        
        $name = $nm;
        $event = $ev;
        $set = $st;
        
        $sql = "INSERT INTO";
        
        $this->con->query($sql);        
    }
    //Aktuallisiert Preis
    public function updatePrice($nm,$pl,$ev,$st) {
               
        $name = $nm;
        $player = $pl;
        $event = $ev;
        $set = $st;
        
        $sql = "UPDATE";
        
        $this->con->query($sql); 
    }

}