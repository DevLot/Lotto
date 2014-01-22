<?php

class Game {
    /* Variabeln definieren */

    private $event;         //EventID
    private $round;           //Durchgang 
    private $startTime;     //Startzeit
    private $endTime;       //Stopzeit
    private $duration;      //in Sekunden
    private $playerList = array();    //Teilnehmerlist
    private $cardList = array();      //Vergebene Spielkarten
    private $lotteryNr = array();     //Gezogene Nummern
    private $winnerList = array();    //Gewinnerliste
    private $priceList;     //Preisliste

    /* Konstruktor mit Übergabeparameter */

    function __construct($event) {

        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->event = $event;
        $this->startTime = time();
        $this->round = 1;
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
    public function getRound() {
        return $this->round;
    }

    //Setzt Durchgang
    public function setRound($round) {
        $this->round = $round;
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
    
    public function stopGame($eventId) {
        
    }

    //Holt Dauer in Sekunden
    public function getDuration() {
        $actuallTime = time();
        $this->duration = (($actuallTime) - ($this->startTime));
    }

    //Holt 3. Reihe
    public function getPlayerList() {
        $registrationList = $this->mysqlAdapter->getRegistration($this->event);                   //Holt alle Registrations Objekte von einem Event und speichert sie in einem Array
        if (!empty($registrationList)) {                                                          //Prüft das Array, ob das angegebene Event schon Registrationen besitzt
            foreach ($registrationList as $registration) {                                        //Jedes Registrations Objekt auslesen
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
        $tempCardList = array();
        foreach ($this->playerList as $player) {
            if (!empty($player) && is_object($player)) {
                $playerId = $player->getId();
                echo "SpielerID: {$playerId},  ";
                $tempCardList[] = $this->mysqlAdapter->getPlayerCards($playerId);
            }
        }
        foreach ($tempCardList as $cards) {
            $i++;
            echo "Array:{$i}";
            foreach ($cards as $card) {
                $this->cardList[] = $card;
            }
        }

        return $this->cardList;
    }

    //Holt Player
    public function getLotteryNr() {
        $history = $this->mysqlAdapter->getHistory(2, 1);
        if(!empty($history)) {

            $this->lotteryNr[] = preg_split("/,/", ($history->getNumbers()), -1, PREG_SPLIT_NO_EMPTY);
            if(!empty($this->lotteryNr) && is_array($this->lotteryNr)) {
                return $this->lotteryNr;
            } else{
                
                return null;
            }
        }
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
              $historylist[] = $this->mysqlAdapter->getHistory($event,$round); //Holt die History eines bestimmten Events und Serie
              foreach ($historylist as $history) {
              $numbers = $history->getNumbers();//Holt die gezogenen Nummern
              $round = $history->getSet();//Holt die die dazugehörige Serie

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
