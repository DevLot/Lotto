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
    private $history;       //History Objekt

    /* Konstruktor mit Übergabeparameter */

    function __construct($event) {

        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->event = $event;
        $this->createDate();
        $this->round = 1;
        $this->newHistory();
        $this->createPlayerList();
        $this->createCardList();
        
    }

    //Holt Event
    public function getEvent() {
        return $this->event;
    }

    //Setzt Event
    public function setEvent($event) {
        $this->event = $event;
    }
    
    //Setzt Event
    public function createDate() {
        $date = new DateTime('NOW');
        $this->startTime = $date->format("Y-m-d H:i:s");
    }
    //Setzt Durchgang
    public function newHistory() {
       $this->history = new History(null, $this->event, $this->round, null, $this->startTime, $this->startTime);
       $this->mysqlAdapter->setHistory($this->history);
       $this->history = $this->mysqlAdapter->getHistory($this->event, $this->round);
    }

    //Holt Durchgang
    public function getRound() {
        return $this->round;
    }

    //Setzt Durchgang
    public function endRound() {
        $this->round = ($this->round +1);
    }
    
    //Holt Durchgang
    public function addNumber($nr) {
        if($this->history->getNumbers() == null) {
            $this->history->setNumbers("{$nr}");
        }
        else {
           $nrs = $this->history->getNumbers();
           $nrs .= ",{$nr}";
           $this->history->setNumbers("{$nrs}");
        }
        $this->mysqlAdapter->updateHistory($this->history);   
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
    public function createPlayerList() {
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
    /**
    * Returns all cards of a event
    * @param type $id
    * @return array\Card|null
    */
    public function createCardList() {

        $tempCardList = array();
        foreach ($this->playerList as $player) {
            if (!empty($player) && is_object($player)) {
                $playerId = $player->getId();
                $tempCardList[] = $this->mysqlAdapter->getPlayerCards($playerId);
            }
            else {
                echo "Keine Spieler vorhanden!";
                return null;
            }
        }
        foreach ($tempCardList as $cards) {
            foreach ($cards as $card) {
                $this->cardList[] = $card;
            }
        }

        return $this->cardList;
    }
   
    public function getCardList() {
            return $this->cardList;
    }

    //Holt Lottozahlen einer Runde
    public function getLotteryNr() {
        $this->history = $this->mysqlAdapter->getHistory($this->event, $this->round);
        if(!empty($this->history)) {
            $this->lotteryNr = preg_split("/,/", ($this->history->getNumbers()), -1, PREG_SPLIT_NO_EMPTY);
            if(!empty($this->lotteryNr) && is_array($this->lotteryNr)) {
                return $this->lotteryNr;
            } else {
                return null;
            }
        }
    }

    //Setzt Player
    public function getWinnerList() {
       
    }

    //Holt Erstell Datum/Zeit
    public function getPriceList() {
        return $this->create_on;
    }

    //Holt Aktuallisierungs Datum/Zeit
    public function getUpdateOn() {
        return $this->update_on;
    }

        function checkWin() {//Prüft ob die gezogenen Nummern mit einer mit einer Karte übereinstimmt.
            
            foreach ($this->cardList as $card) {
               $line1 = preg_split("/,/", ($card->getLine1()), -1, PREG_SPLIT_NO_EMPTY);
               $line2 = preg_split("/,/", ($card->getLine2()), -1, PREG_SPLIT_NO_EMPTY);
               $line3 = preg_split("/,/", ($card->getLine3()), -1, PREG_SPLIT_NO_EMPTY);
               foreach ($this->lotteryNr as $winNr) {
                   foreach ($line1 as $nr) {
                       if($nr == $winNr){
                           $winnerId = $card->getPlayer();
                           //$this->winnerList = ;
                       }
                       
                   }
                   
               }       
            }
            
        }
}
