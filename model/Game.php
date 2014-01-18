<?php

class Game {
    /* Variabeln definieren */

    private $event;         //EventID
    private $set;           //Durchgang 
    private $startTime;     //Startzeit
    private $endTime;       //Stopzeit
    private $duration;      //in Sekunden
    private $registrationList;
    private $playerList = array();    //Teilnehmerlist
    private $cardList = array();      //Vergebene Spielkarten
    private $lotteryNr;     //Gezogene Nummern
    private $winnerList;    //Gewinnerliste
    private $priceList;     //Preisliste

    /* Konstruktor mit Übergabeparameter */

    function __construct($event) {

        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->event = $event;
        $this->startTime = time();
        $this->set = 1;
    }

    //Holt Event
    public function getEvent() {
        return $this->event;
    }

    //Setzt Event
    public function setEvent($event) {
        $this->event = $event;
    }

    //Holt Durchgang
    public function getSet() {
        return $this->set;
    }

    //Setzt Durchgang
    public function setSet($set) {
        $this->set = $set;
    }

    //Holt Startzeit
    public function getStartTime() {
        return $this->startTime;
    }

    //Holt 2. Reihe
    public function getEndTime() {
        if (!empty($this->endTime)) {
            return $this->endTime;
        } else {
            return null;
        }
    }

    //Holt Dauer in Sekunden
    public function getDuration() {
        $actuallTime = time();
        $this->duration = (($actuallTime) - ($this->startTime));
    }

    //Holt 3. Reihe
    public function getPlayerList() {
        
        $this->registrationList = $this->mysqlAdapter->getRegistration($this->event);                   //Holt alle Registrations Objekte von einem Event und speichert sie in einem Array
        if (!empty($this->registrationList)) {                                                          //Prüft das Array, ob das angegebene Event schon Registrationen besitzt
            foreach ($this->registrationList as $registration) {                                        //Jedes Registrations Objekt auslesen
                $playerId = $registration->getPlayer();                                                 //PlayerID der Registration holen
                $this->playerList[] = $this->mysqlAdapter->getPlayer($playerId);                              //Spieler Objekt holen und in ein array() speichern
            }
            return $this->playerList;                                                                         //Array() mit Spielern zurückgeben
        } else {                                                                                        //Sonst Fehlermeldung
            echo "Keine Spieler dem Spiel:\"{$this->event}\" zugeteilt!";
            return null;
        }
    }

    //Setzt 3. Reihe
    public function getCardList() {
        $i = 0;
        foreach ($this->playerList as $player) {
            if (!empty($player) && is_object($player)) {
                $playerId = $player->getId();
                echo "SpielerID: {$playerId},  ";
                $this->cardList[] = $this->mysqlAdapter->getPlayerCards($playerId);
            }
        }
        foreach ($this->cardList as $cards) {
            $i++;
            echo "Array:{$i}";
            $this->cardList = array_merge($this->cardList, $cards);
        }
        return $this->cardList;
    }

    //Holt Player
    public function getLotteryNr() {
        return $this->player;
    }

    //Setzt Player
    public function getWinnerList() {
        $this->player = $player;
    }

    //Holt Erstell Datum/Zeit
    public function getPriceList() {
        return $this->create_on;
    }

    //Holt Aktuallisierungs Datum/Zeit
    public function getUpdateOn() {
        return $this->update_on;
    }

    function eventPlayers($event) {
        $playerCount = 0;
        $cardCount = 0;

        $this->playerList = $this->mysqlAdapter->getRegistration($event); //Holt alle Spieler eines bestimmten Events
        foreach ($playerList as $player) {
            if (!empty($player) && is_object($player)) {
                $playercount++;
                $playerId = $player->getPlayer();
                echo "SpielerID: {$playerId},  ";
                $this->cardList = $this->mysqlAdapter->getPlayerCards($playerId);
                if (empty($cardList) || !is_object($cardList)) {
                    echo "Keine Karten zugewiesen";
                } else {
                    echo "Kein Spieler dem Event zugewiesen";
                }
            }
            /*
              $historylist[] = $this->mysqlAdapter->getHistory($event,$set); //Holt die History eines bestimmten Events und Serie
              foreach ($historylist as $history) {
              $numbers = $history->getNumbers();//Holt die gezogenen Nummern
              $set = $history->getSet();//Holt die die dazugehörige Serie

              }

             */
        }

        function checkMatch() {//Prüft ob die gezogenen Nummern mit einer mit einer Karte übereinstimmt.
            $cardlist[] = $this->mysqlAdapter->getCards();
            foreach ($cardlist as $value) {
                $card = $value;
                $line1[] = preg_split(',', ($card->getLine1()), -1, PREG_SPLIT_NO_EMPTY);
                $line2[] = preg_split(',', ($card->getLine2()), -1, PREG_SPLIT_NO_EMPTY);
                $line3[] = preg_split(',', ($card->getLine3()), -1, PREG_SPLIT_NO_EMPTY);
                foreach ($line1 as $number) {
                    
                }
            }
        }

    }

}
