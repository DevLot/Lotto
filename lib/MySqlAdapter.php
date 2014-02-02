<?php

final class MySqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;
    private $sql;

    /**
     * Constructor
     */
    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        $this->open();
    }

    /**
     * Destructor
     */
    public function __destruct() {
        $this->close();
    }

    /**
     * New connect to the DB 
     */
    private function open() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_errno) {
            echo 'DB Error: ' . $this->con->connect_error;
            $this->con = null;
        } else {
            $this->con->set_charset('utf8');
        }
    }

    /**
     * Close the connection to the DB
     */
    private function close() {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }

    /* Funktionen für Zugriff auf DB:
     * - getHistorys()
     * - getHistory($event, $round)
     * - setHistory($history)
     * - updateHistory($history)
     * - deletHistory($id)
     * - getCards()
     * - getCard($id)
     * - getPlayerCards($player)
     * - createCard($card)
     * - updateCard($card)
     * - deletCard($id)
     * - getPlayers()
     * - getPlayer($id)
     * - createPlayer($player)
     * - updatePlayer($player)
     * - deletPlayer($id)
     * - getEvents()
     * - getEvent($id)
     * - getOpenEvents()
     * - createEvent($event)
     * - updateEvent($event)
     * - deletEvent($id)
     * - getPrices()
     * - getPrice($id)
     * - createPrices($price)
     * - updatePrice($price)
     * - deletPrice($id)
     * - getRegistrations()
     * - getRegistration($event)
     * - setRegistration($registration)
     * - updateRegistration($registration)
     * - deletRegistration($id)
     * - checkActiveGame($id)
     * - getLastRoun($event)
     * 
     */

    /**
     * Returns all Historys
     * @return $historylist[]
     *  
     */
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

    /**
     * Returns the Price by given event and round if present, null otherwiset
     * @param int $event, int $round
     * @return $history 
     */
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

    /**
     * Create a new History entry in the db
     * @param object $history
     *  
     */
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

    /**
     * Update a History entry
     * @param object $history
     *  
     */
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

    /**
     * Delets a History from the Database
     * @param int $id
     * @return null 
     * 
     */
    public function deletHistory($id) {
        $this->con->query("DELET FROM fabingo.history WHERE id='$id'");
    }

    /**
     * Returns all Cards
     * @return $cardlist[]
     *  
     */
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
     * Returns the Card by given id if present, null otherwiset
     * @param int $id
     * @return $card 
     */
    public function getCard($id) {
        $res = $this->con->query("SELECT * FROM fabingo.cards WHERE id='$id'");
        while ($row = $res->fetch_assoc()) {
            $card = new Card($row['id'], $row['cardnr'], $row['line1'], $row['line2'], $row['line3'], $row['player'], $row['create_on'], $row['update_on']);
            $res->free();
            return $card;
        }
        if (empty($row) || !is_object($row)) {
            return NULL;
        }
    }

    /**
     * Returns all cards of one Player by his id
     * @param object $player
     * @return $card
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

    /**
     * Create a Card entry
     * @param object $card
     *  
     */
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

    /**
     * Update a Card entry
     * @param object $card
     *  
     */
    public function updateCard($card) {

        $id = $card->getId();
        $cardnr = $card->getCardnr();
        $line1 = $card->getLine1();
        $line2 = $card->getLine2();
        $line3 = $card->getLine3();
        $player = $card->getPlayer();

        $sql = "UPDATE fabingo.cards SET line1 = '$line1', line2 = '$line2', line3 = '$line3', player = '$player', update_on = CURRENT_TIMESTAMP() WHERE id = '$id' AND cardnr = '$cardnr'";

        $this->con->query($sql);
    }

    /**
     * Delets a Card from the Database
     * @param int $id
     * @return null 
     * 
     */
    public function deletCard($id) {
        $this->con->query("DELET FROM fabingo.cards WHERE id='$id'");
    }

    /**
     * Returns all Players
     * @return $playerlist[]
     *  
     */
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

    /**
     * Returns the Player by given id if present, null otherwiset
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

    /**
     * Create a new Player
     * @param object $player
     *  
     */
    public function createPlayer($player) {

        $firstname = $player->getFirstname();
        $surname = $player->getSurname();
        $birthdate = $player->getBirthdate();
        $address = $player->getAddress();
        $zipcode = $player->getZicode();
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
                    '$firstname','$surname','$birthdate','$address','$zipcode','$city','$phone','$mobile','$mail','$status',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()               
                );
         ";

        $this->con->query($sql);


        echo '<p>Eintrag erfolgreich!</p>
        <div class="button"><a href="/player">Danke!</a></div>';
    }

    /**
     * Update a Player entry
     * @param object $player
     * 
     */
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

        $sql = "UPDATE fabingo.players SET firstname = '$firstname', surname = '$surname', birthdate = '$birthdate', address = '$address', zipcode = '$zipcode', city = '$city', phone = '$phone', mobile = '$mobile', mail = '$mail', update_on = CURRENT_TIMESTAMP()  WHERE id = '$id'";

        $this->con->query($sql);
    }

    /**
     * Delets a Player from the Database
     * @param int $id
     * @return null 
     * 
     */
    public function deletPlayer($id) {
        $this->con->query("UPDATE fabingo.players SET status=0 WHERE id='$id'");
    }

    /**
     * Returns all Events
     * @return Event 
     * 
     */
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
     * @return $event 
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

    /**
     * create new Event entry in the db
     * @param object $event 
     * 
     */
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

    /**
     * Update a Event entry
     * @param $event 
     * 
     */
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

    /**
     * Delets a Event from the Database
     * @param int $id 
     * 
     */
    public function deletEvent($id) {
        $this->con->query("DELET FROM fabingo.events WHERE id='$id'");
    }

    /**
     * Returns all Prices
     * @return $pricelist[] 
     * 
     */
    public function getPrices() {

        $pricelist = array();
        $res = $this->con->query("SELECT * FROM fabingo.prices ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $price = new Price($row['id'], $row['name'], $row['player'], $row['event'], $row['set'], $row['create_on'], $row['update_on']);
            $pricelist[] = $price;
        }
        $res->free();
        return $pricelist;
    }

    /**
     * Returns the Price by given id if present, null otherwiset
     * @param int $id
     * @return $price 
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

    /**
     * Create a new Price entry in the db
     * @param $price 
     * 
     */
    public function createPrices($price) {

        $name = $price->getName();
        $player = $price->getPlayer();
        $event = $price->getEvent();
        $round = $price->getRound();

        $sql = "INSERT INTO fabingo.prices
                (
                    name,player,event,round,create_on,update_on
                )
                VALUES
                (
                    '$name','$player','$event','$round',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()      
                );
         ";

        $this->con->query($sql);
    }

    /**
     * Update a Price entry
     * @param obejct $price
     * 
     */
    public function updatePrice($price) {

        $id = $price->getId();
        $name = $price->getName();
        $player = $price->getPlayer();
        $event = $price->getEvent();
        $round = $price->getRound();

        $sql = "UPDATE fabingo.prices SET name = '$name', player = '$player', event = '$event', round = '$round', update_on = CURRENT_TIMESTAMP() WHERE id = '$id'";

        $this->con->query($sql);
    }

    /**
     * Delets a Price from the Database
     * @param int $id
     * 
     */
    public function deletPrice($id) {
        $this->con->query("DELET FROM fabingo.prices WHERE id='$id'");
    }

    /**
     * Returns all Registrations
     * @return $registrationlist[] 
     * 
     */
    public function getRegistrations() {

        $registrationlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.registration ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $registration = new Registration($row['id'], $row['player'], $row['event'], $row['create_on'], $row['update_on']);
            $registrationlist[] = $registration;
        }
        $res->free();
        return $registrationlist;
    }

    /**
     * Returns the Registration by given event if present, null otherwiset
     * @param object $event
     * @return $registrationlist
     *  
     */
    public function getRegistration($event) {

        $registrationlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.registration WHERE event='$event' ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $registration = new Registration($row['id'], $row['player'], $row['event'], $row['create_on'], $row['update_on']);
            $registrationlist[] = $registration;
        }
        $res->free();
        return $registrationlist;
    }

    /**
     * Create a new Regit^stration entry
     * @param object $registration 
     */
    public function createRegistration($registration) {

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

    /**
     * Update Registration entry
     * @param object $registration
     * 
     */
    public function updateRegistration($registration) {

        $id = $registration->getId();
        $player = $registration->getPlayer();
        $event = $registration->getEvent();

        $sql = "UPDATE fabingo.registration SET player = '$player', event = '$event', update_on = CURRENT_TIMESTAMP() WHERE id = '$id'";

        $this->con->query($sql);
    }

    /**
     * Delets a Registration from the Database
     * @param int $id
     * @return null 
     * 
     */
    public function deletRegistration($id) {
        $this->con->query("DELET FROM fabingo.registration WHERE id='$id'");
    }

    /**
     * Returns the Event by given id if present, null otherwiset
     * @param int $id
     * @return 1 / null 
     * 
     */
    public function checkActiveGame($id) {
        $res = $this->con->query("SELECT * FROM fabingo.history WHERE event='$id'");
        if ($row = $res->fetch_assoc()) {

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
