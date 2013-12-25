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
        
        $historylist = array();
        $res = $this->con->query("SELECT * FROM fabingo.history ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $history = new History($row['id'],$row['event'], $row['set'], $row['numbers']);
            $historylist[] = $history;
        }
        $res->free();
        return $historylist;
    }
    //Aktuallisiert History
    public function updateHistory($history) {
        
    }
    //Holt Spielkarten
    public function getCard() {
      
        $res = $this->con->query("SELECT * FROM fabingo.cards ORDER BY id");
        
        $cardlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.cards ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $cards = new Card($row['id'],$row['cardnr'], $row['line1'], $row['line2'],$row['line3'],$row['player']);
            $cardlist[] = $cards;
        }
        $res->free();
        return $cardlist;
    }

    
    //Erstellt Spielkarte
    public function createCard($card) {
        
        $cardnr = $card->getCardnr();
        $line1 = $card->getLine1();
        $line2 = $card->getLine2();
        $line3 = $card->getLine3();
        $player = $card->getPlayer();
        
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
    //Aktualisiert Spielkarte
    public function updateCards($card) {
        
        $cardnr = $card->getCardnr();
        $line1 = $card->getLine1();
        $line2 = $card->getLine2();
        $line3 = $card->getLine3();
        $player = $card->getPlayer();
        
        $sql = "UPDATE";
        
        $this->con->query($sql);
    }
    //Holt Spieler
    public function getPlayers() {
        
        $playerlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.players ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $player = new Player($row['id'],$row['firstname'], $row['surname'], $row['birthdate'], $row['address'], $row['zipcode'], $row['city'], $row['phone'], $row['mobile'], $row['mail']);
            $playerlist[] = $player;
        }
        $res->free();
        return $playerlist;
    }

    //Erstellt Spieler
    public function createPlayer($player) {
       
        $firstname = $player->getFirstname();
        $surname = $player->getSurname();
        $birthdate = $player->getBirthdate();
        $address = $player->getAddress();
        $zipcode = $player->getZipcode();
        $city = $player->getCity();
        $phone = $player->getPhone();
        $mobile = $player->getMobile();
        $mail = $player->getMail();

        $sql = "INSERT INTO fabingo.players
                (
                    firstname,surname,birthdate,address,zipcode,city,phone,mobile,mail,create_on,update_on
                )
                VALUES
                (
                    '$firstname','$surname','$birthdate','$address','$zipcode','$city','$phone','$mobile','$mail',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()               
                );
         ";

        $this->con->query($sql);

                
        echo '<p>Eintrag erfolgreich!</p>
        <div class="button"><a href="/player">Danke!</a></div>';

    }
    //Aktuallisier Spieler
    public function updatePlayer($player) {
        
        $firstname = $player->getFirstname();
        $surname = $player->getSurname();
        $birthdate = $player->getBirthdate();
        $address = $player->getAddress();
        $zipcode = $player->getZipcode();
        $city = $player->getCity();
        $phone = $player->getPhone();
        $mobile = $player->getMobile();
        $mail = $player->getMail();
        
        $sql = "UPDATE";
        
        $this->con->query($sql);      
    }
    //Holt Event
    public function getEvents() {
        
    }
    //Erstellt Event
    public function createEvents($event) {
        
        $name = $event->getName();
        $date = $event->getDate();
        $location = $event->getLocation();
        $host = $event->getHost();
        
        $sql = "INSERT INTO fabingo.events
                (
                    name,date,location,create_on,update_on
                )
                VALUES
                (
                    '$name','$date','$location','$host',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()      
                );
         ";
       
        $this->con->query($sql);
    }
    //Aktuallisiert Event
    public function updateEvents($event) {
     
        $name = $event->getName();
        $date = $event->getDate();
        $location = $event->getLocation();
        $host = $event->getHost();
        
        $sql = "UPDATE";
        
        $this->con->query($sql);
    }
    //Holt Preis
    public function getPrice() {
        
    }
    //Erstellt Preis
    public function createPrice($preic) {
        
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
