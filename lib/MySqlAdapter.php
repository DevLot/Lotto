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

    /* Funktionen für Zugriff auf DB:
     * - getHistorys()
     * - getHistory($event)
     * - setHistory()
     * - updateHistory()
     * - getCards()
     * - getCard($id)
     * - createCards()
     * - updateCard()
     * - getPlayers()
     * - getPlayer($id)
     * - createPlayer()
     * - updatePlayer()
     * - getEvents()
     * - getEvent($id)
     * - createEvent()
     * - updateEvent()
     * - getPrices()
     * - getPrice($id)
     * - createPrices()
     * - updatePrice()
     * - getRegistrations()
     * - getRegistration($event)
     * - setRegistration()
     * - updateRegistration()
     * 
     * 
     */

    //Holt History
    public function getHistorys() {

        $historylist = array();
        $res = $this->con->query("SELECT * FROM fabingo.history ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $history = new History($row['id'], $row['event'], $row['round'], $row['numbers'], $row['create_on'], $row['update_on']);
            $historylist[] = $history;
        }
        $res->free();
        return $historylist;
    }

    //Holt History von Event der Serie
    public function getHistory($event, $round) {

        $res = $this->con->query("SELECT * FROM fabingo.history WHERE event='$event' AND round='$round'");
        while ($row = $res->fetch_assoc()) {
            $history = new History($row['id'], $row['event'], $row['round'], $row['numbers'], $row['create_on'], $row['update_on']);
            $res->free();
            return $history;
        }

        if (empty($row) || !is_object($row)) {
            return null;
        }
    }

    //Setzt History
    public function setHistory($history) {

        $event = $history->getEvent();
        $round = $history->getRound();
        $numbers = $history->getNumbers();
        $create_on = $history->getCreateOn();
        $update_on = $history->getUpdateOn();

        $sql = "INSERT INTO fabingo.history
                (event,round,numbers,create_on,update_on) 
                    VALUES 
                ('$event','$round','$numbers','$create_on','$update_on');";

        $this->con->query($sql);

        //echo "History Import efoglreich";
    }

    //Aktuallisiert History
    public function updateHistory($history) {

        //$id = $history->getId();
        $event = $history->getEvent();
        $round = $history->getRound();
        $numbers = $history->getNumbers();

        $sql = "UPDATE fabingo.history 
            SET numbers='$numbers', update_on=CURRENT_TIMESTAMP() 
                WHERE event='$event' AND round='$round'";


        $this->con->query($sql);

        echo $event;
        echo $round;
        echo $numbers;
        echo $sql;

        echo "update erfolgreich";
    }

    //Holt Spielkarten
    public function getCards() {

        $cardlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.cards ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $card = new Card($row['id'], $row['cardnr'], $row['line1'], $row['line2'], $row['line3'], $row['player'], $row['create_on'], $row['update_on']);
            $cardlist[] = $card;
        }
        $res->free();
        return $cardlist;
    }

    /**
     * Returns the event by given id if present, null otherwiset
     * @param int $id
     * @return Card 
     */
    public function getCard($id) {
        $res = $this->con->query("SELECT * FROM fabingo.cards WHERE id='$id'");
        while ($row = $res->fetch_assoc()) {
            $card = new Card($row['id'], $row['cardnr'], $row['line1'], $row['line2'], $row['line3'], $row['player'], $row['status']);
        }

//        if (empty($row) || !is_object($row)) {
//            return NULL;
//        }
        $res->free();
        return $card;
    }

    /**
     * Returns all cards of one Player by his id
     * @param type $id
     * @return \Card|null
     */
    public function getPlayerCards($player) {
        $cardlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.cards WHERE player='$player'");
        while ($row = $res->fetch_assoc()) {
            $card = new Card($row['id'], $row['cardnr'], $row['line1'], $row['line2'], $row['line3'], $row['player'], $row['create_on'], $row['update_on']);
            $cardlist[] = $card;
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
        $status = $card->getStatus();

        $sql = "INSERT INTO fabingo.cards
                (
                    cardnr,line1,line2,line3,player,status,create_on,update_on
                )
                VALUES
                (
                    '$cardnr','$line1','$line2','$line3',null,'$status',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()                   
                );
         ";

        $this->con->query($sql);
        
      



    }

    //Aktualisiert Spielkarte
    public function updateCard($card) {

        $id = $card->getId();
        $cardnr = $card->getCardnr();
        $line1 = $card->getLine1();
        $line2 = $card->getLine2();
        $line3 = $card->getLine3();
  

        $sql = "UPDATE fabingo.cards SET line1 = '$line1', line2 = '$line2', line3 = '$line3', update_on = CURRENT_TIMESTAMP() WHERE id = '$id' AND cardnr = '$cardnr'";

        $this->con->query($sql);
    }

    //Holt Spieler
    public function getPlayers() {

        $playerlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.players ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $player = new Player($row['id'], $row['firstname'], $row['surname'], $row['birthdate'], $row['address'], $row['zipcode'], $row['city'], $row['phone'], $row['mobile'], $row['mail'], $row['status'], $row['create_on'], $row['update_on']);
            $playerlist[] = $player;
        }
        $res->free();
        return $playerlist;
    }

    //Holt Spieler, die in einem Event registriert sind
    public function getRegistrationPlayers($event) {

        $playerlist = array();
        $res = $this->con->query("SELECT players.id,players.firstname,players.surname,players.birthdate,players.address,players.zipcode,players.city,players.phone,players.mobile,players.mail,players.status,players.create_on,players.update_on FROM fabingo.players LEFT JOIN fabingo.registration ON registration.player=players.id WHERE event='$event' ORDER BY players.id;");
        while ($row = $res->fetch_assoc()) {
            $player = new Player($row['id'], $row['firstname'], $row['surname'], $row['birthdate'], $row['address'], $row['zipcode'], $row['city'], $row['phone'], $row['mobile'], $row['mail'], $row['status'], $row['create_on'], $row['update_on']);
            $playerlist[] = $player;
        }
        $res->free();
        return $playerlist;
    }

    //Holt Spielervorname, Mail und deren Preis von einem Event
    public function getWinPlayers($event) {

        $maillist = array();
        $res = $this->con->query("SELECT prices.name,players.firstname,players.mail FROM fabingo.players LEFT JOIN fabingo.prices ON prices.player=players.id WHERE event='$event' ORDER BY prices.id");
        while ($row = $res->fetch_assoc()) {
            $pricemail = new PriceMail($row['price'], $row['firstname'], $row['mail']);
            $maillist[] = $pricemail;
        }
        $res->free();
        return $maillist;
    }

    /**
     * Returns the Card by given id if present, null otherwiset
     * @param int $id
     * @return $player 
     */
    public function getPlayer($id) {
        $res = $this->con->query("SELECT * FROM fabingo.players WHERE id='$id'");

        while ($row = $res->fetch_assoc()) {
            $player = new Player($row['id'], $row['firstname'], $row['surname'], $row['birthdate'], $row['address'], $row['zipcode'], $row['city'], $row['phone'], $row['mobile'], $row['mail'], $row['status'], $row['create_on'], $row['update_on']);
        }
        $res->free();
        return $player;
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
        $status = $player->getStatus();

        $sql = "INSERT INTO fabingo.players
                (
                    firstname,surname,birthdate,address,zipcode,city,phone,mobile,mail,status,create_on,update_on
                )
                VALUES
                (
                    '$firstname','$surname','$birthdate','$address','$zipcode','$city','$phone','$mobile','$mail',null,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()               
                );
         ";

        $this->con->query($sql);
        print_r($sql);


    }

    //Aktuallisier Spieler
    public function updatePlayer($player) {

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

        $sql = "UPDATE fabingo.players SET firstname = '$firstname', surname = '$surname', birthdate = '$birthdate', address = '$address', zipcode = '$zipcode', city = '$city', phone = '$phone', mobile = '$mobile', mail = '$mail', update_on = CURRENT_TIMESTAMP() WHERE id = '$id'";

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

    /**
     * Returns the Event by given id if present, null otherwiset
     * @param int $id
     * @return Event 
     * !empty($row) && array_key_exists($id, $row)
     */
    public function getEvent($id) {
        $res = $this->con->query("SELECT * FROM fabingo.events WHERE id='$id'");
        if ($row = $res->fetch_assoc()) {
            $event = new Event($row['id'], $row['name'], $row['date'], $row['location'], $row['organizer'], $row['duration'], $row['create_on'], $row['update_on']);
            $res->free();
            return $event;
        } else {
            return NULL;
        }
    }

    /**
     * Returns all open Events
     * @return $eventlist[] 
     * 
     */
    public function getOpenEvents() {
        $eventlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.events WHERE date >= CURDATE();");
        while ($row = $res->fetch_assoc()) {
            $event = new Event($row['id'], $row['name'], $row['date'], $row['location'], $row['organizer'], $row['duration'], $row['create_on'], $row['update_on']);
            $eventlist[] = $event;
        }
        $res->free();
        return $eventlist;
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
                );"
        ;

        $this->con->query($sql);
    }

    //Aktuallisiert Event
    public function updateEvent($event) {

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
            $price = new Price($row['id'], $row['name'], $row['player'], $row['event'], $row['round'], $row['line'], $row['card'], $row['create_on'], $row['update_on']);
            $pricelist[] = $price;
        }
        $res->free();
        return $pricelist;
    }

    /**
     * Returns the Event by given id if present, null otherwiset
     * @param int $id
     * @return Event 
     */
    public function getPrice($id) {
        $res = $this->con->query("SELECT * FROM fabingo.prices WHERE id='$id'");
        if ($row = $res->fetch_assoc()) {
            $price = new Price($row['id'], $row['name'], $row['player'], $row['event'], $row['set'], $row['create_on'], $row['update_on']);
            $res->free();
            return $price;
        } else {
            return NULL;
        }
    }

    //Erstellt Preis
    public function createPrice($price) {

        $name = $price->getName();
        $player = $price->getPlayer();
        $event = $price->getEvent();
        $round = $price->getRound();
        $line = $price->getLine();
        $card = $price->getCard();

        $sql = "INSERT INTO fabingo.prices
                (
                    name,player,event,round,line,card,create_on,update_on
                )
                VALUES
                (
                    '$name','$player','$event','$round','$line','$card',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()      
                );
         ";

        $this->con->query($sql);
    }

    //Aktuallisiert Preis
    public function updatePrice($price) {

        //$id = $price->getId();
        $name = $price->getName();
        $player = $price->getPlayer();
        $event = $price->getEvent();
        $round = $price->getRound();
        $line = $price->getLine();

        $sql = "UPDATE fabingo.prices SET name = '$name' WHERE player = '$player' AND event = '$event' AND name=''";

        $this->con->query($sql);
    }

    //Überprüft ob Treffer bereits in DB
    public function checkPrice($player, $event, $round, $line) {

        $res = $this->con->query("SELECT * FROM fabingo.prices WHERE player='$player' AND event='$event' AND round='$round' AND line='$line'");
        // $res = $this->con->query("SELECT * FROM fabingo.prices WHERE player='3' AND event='3' AND round='3' AND line='3'");
        $row = $res->fetch_assoc();
        if (!$row) {
            return false;
        }
        return true;
    }

    //Zeit alle Gewinne an ohne Preise
    public function getPricesOpen($event) {

        $pricelist = array();
        $res = $this->con->query("SELECT * FROM fabingo.prices WHERE event='$event' AND name='' ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $price = new Price($row['id'], $row['name'], $row['player'], $row['event'], $row['round'], $row['line'], $row['card'], $row['create_on'], $row['update_on']);
            $pricelist[] = $price;
        }
        $res->free();
        return $pricelist;
    }

    //Holte Registration von einem Event
    public function getRegistration($event) {

        $registrationlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.registration WHERE event='$event' ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $registration = new Registration($row['id'], $row['player'], $row['event'], $row['created_on'], $row['updated_on']);
            $registrationlist[] = $registration;
        }
        $res->free();
        return $registrationlist;
    }

    //Setzt Registration
    public function setRegistration($registration) {

        $player = $registration->getPlayer();
        $event = $registration->getEvent();

        $sql = "INSERT INTO fabingo.registration
                (
                    player,event,created_on,updated_on
                )
                VALUES
                (
                    '$player','$event',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()                   
                );
         ";

        $this->con->query($sql);
    }

    //Löscht Registration
    public function deleteRegistration($registration) {

        $player = $registration->getPlayer();
        $event = $registration->getEvent();

        $sql = "DELETE FROM fabingo.registration WHERE player = '$player' AND event = '$event'";

        $this->con->query($sql);
    }

    /**
     * Returns the Event by given id if present, null otherwiset
     * @param int $id
     * @return 1 / null 
     * 
     */
    public function checkActiveGame($id) {
        $res = $this->con->query("SELECT * FROM fabingo.history WHERE event='$id'");
        if ($res->fetch_assoc()) {

            echo "<div class='infobox'>Dieses Spiel läuft gerade</div>";
            return 1;
        } else {
            echo "<div class='infobox ok'>Herzlich willkommen!</div>";
            return null;
        }
        $res->free();
    }

    /**
     * Returns the Event by given id if present, null otherwiset
     * @param int $id
     * @return 1 / null 
     * 
     */
    public function getLastRound($event) {
        $res = $this->con->query("SELECT max(round) FROM fabingo.history WHERE event='$event'");
        while ($row = $res->fetch_assoc()) {
            return $row['max(round)'];
        }
        $res->free();
    }

}
