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
 * - setHistory()
 * - updateHistory()
 * - getCards()
 * - getCard($id)
 * - createCards()
 * - updateCards()
 * - getPlayers()
 * - createPlayer()
 * - updatePlayers()
 * - getEvents()
 * - createEvent()
 * - updateEvents()
 * - getPrices()
 * - createPrices()
 * - updatePrices()
 * - getRegistration()
 * - setRegistration()
 * - updateRegistration()
 * 
 */

    //Holt History
    public function getHistory() {
        
        $historylist = array();
        $res = $this->con->query("SELECT * FROM fabingo.history ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $history = new History($row['id'],$row['event'], $row['set'], $row['numbers'], $row['create_on'], $row['update_on']);
            $historylist[] = $history;
        }
        $res->free();
        return $historylist;
    }
    //Setzt History
    public function setHistory($history) {
        
        $event = $history->getEvent();
        $set = $history->getSet();
        $numbers = $history->getNumbers();
        
        $sql = "INSERT INTO fabingo.history
                (
                    event,set,numbers,create_on,update_on
                )
                VALUES
                (
                    '$event','$set','$numbers',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()                   
                );
         ";
        
        $this->con->query($sql);
    }

    
       /**
     * Returns the event by given id if present, null otherwiset
     * @param int $id
     * @return Card 
     */
    public function getCard($id) {
        $list = $this->getCards();
        return $list[$id];
//        if (!empty($list) && array_key_exists($id, $list)) {
//            return $list[$id];
//        }
//        return null;
    }



    //Aktuallisiert History
    public function updateHistory($history) {
        
        $id = $history->getId();
        $event = $history->getEvent();
        $set = $history->getSet();
        $numbers = $history->getNumbers();
                
        $sql = "UPDATE fabingo.history SET numbers = '$numbers', update_on = CURRENT_TIMESTAMP() WHERE id = '$id' AND event = '$event' AND set = '$set'";
        
        $this->con->query($sql);
    }
    
    //Holt Spielkarten
    public function getCards() {
              
        $cardlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.cards ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $cards = new Card($row['id'],$row['cardnr'], $row['line1'], $row['line2'],$row['line3'],$row['player'], $row['create_on'], $row['update_on']);
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
        
        $sql = "INSERT INTO fabingo.cards
                (
                    cardnr,line1,line2,line3,player,create_on,update_on
                )
                VALUES
                (
                    '$cardnr','$line1','$line2','$line3','$player',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()                   
                );
         ";
        
        $this->con->query($sql);
        
                        
        echo '<p>Eintrag erfolgreich!</p>
        <div class="button"><a href="/card">Danke!</a></div>';
    }
    //Aktualisiert Spielkarte
    public function updateCards($card) {
        
        $id = $card->getId();
        $cardnr = $card->getCardnr();
        $line1 = $card->getLine1();
        $line2 = $card->getLine2();
        $line3 = $card->getLine3();
        $player = $card->getPlayer();
        
        $sql = "UPDATE fabingo.cards SET line1 = '$line1', line2 = '$line2', line3 = '$line3', player = '$player', update_on = CURRENT_TIMESTAMP() WHERE id = '$id' AND cardnr = '$cardnr'";
        
        $this->con->query($sql);
    }
    
    //Holt Spieler
    public function getPlayers() {
        
        $playerlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.players ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $player = new Player($row['id'],$row['firstname'], $row['surname'], $row['birthdate'], $row['address'], $row['zipcode'], $row['city'], $row['phone'], $row['mobile'], $row['mail'], $row['create_on'], $row['update_on']);
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
    public function updatePlayers($player) {
        
        $id = $player->getId();
        $firstname = $player->getFirstname();
        $surname = $player->getSurname();
        $birthdate = $player->getBirthdate();
        $address = $player->getAddress();
        $zipcode = $player->getZipcode();
        $city = $player->getCity();
        $phone = $player->getPhone();
        $mobile = $player->getMobile();
        $mail = $player->getMail();
        
        $sql = "UPDATE fabingo.players SET firstname = '$firstname', surname = '$surname', birthdate = '$birthdate', address = '$address', zipcode = '$zipcode', city = '$city', phone = '$phone', mobile = '$mobile', mail = '$mail', update_on = CURRENT_TIMESTAMP()  WHERE id = '$id'";
        
        $this->con->query($sql);      
    }
    
    //Holt Events
    public function getEvents() {
        
        $eventlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.events ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $event = new Event($row['id'], $row['name'], $row['date'], $row['location'], $row['organizer'], $row['duration'], $row['create_on'], $row['update_on']);
            $eventlist[] = $event;
            
        }
        $res->free();
        return $eventlist;
        
    }
    //Holt Event
    public function getEvent($id) {
        
        $list = $this->getEvents();
        if (!empty($list) && array_key_exists($id, $list)) {
            return $list[$id];
        }
        return null;
        
    }
    //Erstellt Event
    public function createEvent($event) {
        
        $name = $event->getName();
        $date = $event->getDate();
        $location = $event->getLocation();
        $organizer = $event->getOrganizer();
        //$player = $event->getPlayes()
        
        $sql = "INSERT INTO fabingo.events
                (
                    name,date,location,organizer,create_on,update_on
                )
                VALUES
                (
                    '$name','$date','$location','$organizer',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()      
                );
         ";
       
        $this->con->query($sql);
        
         echo '<p>Eintrag erfolgreich!</p>
        <div class="button"><a href="/event">Danke!</a></div>';
    }
    //Aktuallisiert Event
    public function updateEvents($event) {
        
        $id = $event->getId();
        $name = $event->getName();
        $date = $event->getDate();
        $location = $event->getLocation();
        $organizer = $event->getOrganizer();
        //$player = $event->getPlayers();
        
        $sql = "UPDATE fabingo.events SET name = '$name', date = '$date', location = '$location', organizer = '$organizer', update_on = CURRENT_TIMESTAMP() WHERE id = '$id'";
        
        $this->con->query($sql);
    }
    
    //Holt Preis
    public function getPrices() {
        
        $pricelist = array();
        $res = $this->con->query("SELECT * FROM fabingo.prices ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $price = new Price($row['id'],$row['name'], $row['player'], $row['event'], $row['set'], $row['create_on'], $row['update_on']);
            $pricelist[] = $price;
        }
        $res->free();
        return $pricelist;
    }
    //Erstellt Preis
    public function createPrices($price) {
        
        $id = $price->getId();
        $name = $price->getName();
        $event = $price->getEvent();
        $set = $price->getSet();
        
        $sql = "INSERT INTO fabingo.prices
                (
                    name,event,set,create_on,update_on
                )
                VALUES
                (
                    '$name','$event','$set',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()      
                );
         ";
        
        $this->con->query($sql);        
    }
    //Aktuallisiert Preis
    public function updatePrices($price) {
        
        $id = $price->getId();
        $name = $price->getName();
        $player = $price->getPlayer();
        $event = $price->getEvent();
        $set = $price->getSet();
        
        $sql = "UPDATE fabingo.prices SET name = '$name', player = '$player', event = '$event', set = '$set', update_on = CURRENT_TIMESTAMP() WHERE id = '$id'";
        
        $this->con->query($sql); 
    }
    
    //Holt Registration
    public function getRegistrations() {
        
        $registrationlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.registration ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $registration = new History($row['id'],$row['player'], $row['event'], $row['create_on'], $row['update_on']);
            $registrationlist[] = $registration;
        }
        $res->free();
        return $registrationlist;
    }
    //Setzt Registration
    public function setRegistrations($registration) {
        
        $player = $registrationtration->getPlayer();
        $event = $registration->getEvent();
        
        $sql = "INSERT INTO fabingo.registration
                (
                    player,event,create_on,update_on
                )
                VALUES
                (
                    '$player','$event',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()                   
                );
         ";
        
        $this->con->query($sql);
    }
    //Aktuallisiert Registration
    public function updateRegistrations($registration) {
        
        $id = $registration->getId();
        $player = $registration->getPlayer();
        $event = $registration->getEvent();
                
        $sql = "UPDATE fabingo.registration SET player = '$player', event = '$event', update_on = CURRENT_TIMESTAMP() WHERE id = '$id'";
        
        $this->con->query($sql);
    }

}
