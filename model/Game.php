<?php

class Game {
    /* Variabeln definieren */

    private $event;                 //EventID
    private $round;                 //Durchgang 
    private $startTime;             //Startzeit
    private $endTime;               //Stopzeit
    private $duration;              //in Sekunden
    private $playerList = array();  //Teilnehmerlist
    private $cardList = array();    //Vergebene Spielkarten
    private $lotteryNr = array();   //Gezogene Nummern
    private $winnerList = array();  //Gewinnerliste
    private $priceList = array();   //Preisliste
    private $history;               //History Objekt
    private $eventInfo;             //Event Objekt   

    /** Constructor:
     *  creates mysqli DB connection
     *  set parameter $event to local variable $this->event
     *  set variable $round to 1
     *  creates a new DateTime object 
     *  get the Event object by id from DB  
     *  create new History object for this Eventround
     *  get all registrated Players of the Event
     *  get all Cards of the Players of the Event   */

    function __construct($event) {

        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->event = $event;
        $this->getEventInfo();
        $this->createPlayerList();
        $this->createCardList();
        $this->createDate();


        //Überprüft ob das Game bereits vorhanden ist
        if ($this->mysqlAdapter->checkActiveGame($event) == 0) {
            $this->round = 1;
            $this->newHistory();
        } else {
            $this->round = $this->mysqlAdapter->getLastRound($event);
//            echo "rundez ist" . $this->round;
        }

        $this->lotterynr = $this->getLotteryNr($event, $this->round);
    }

    //Holt Event
    private function getEventInfo() {
        $this->eventInfo = $this->mysqlAdapter->getEvent($this->event);
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

    //creates actuall History object
    public function newHistory() {
        $this->history = new History(null, $this->event, $this->round, null, $this->startTime, $this->startTime);
        $this->mysqlAdapter->setHistory($this->history);
        $this->history = $this->mysqlAdapter->getHistory($this->event, $this->round);
    }

    /**
     * Returns the History object of the actuall round
     * @return object $this->history
     */
    public function getHistory() {
        return $this->history;
    }

    //Holt Durchgang
    public function getRound() {
        return $this->round;
    }

    //Beenden der Runde
    public function endRound($event, $round) {
        $this->round = ++$round;
        $this->event = $event;
        $this->history = $this->newHistory();
        //$this->mysqlAdapter->setHistory($this->history);
        //$this->history = $this->mysqlAdapter->getHistory($this->event, $this->round);
    }

    //Beenden des Spiels
    public function endGame() {
        
    }

    //Holt Durchgang
    public function addNumber($nr) {
        if ($this->history->getNumbers() == null) {
            $this->history->setNumbers("{$nr}");
        } else {
            $nrs = $this->history->getNumbers();
            $nrs .= ",{$nr}";
            $this->history->setNumbers("{$nrs}");
        }
        $this->mysqlAdapter->updateHistory($this->history);
        //$this->getLotteryNr();
        return $this->checkWin();
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
            echo "<div class='infobox warning'>Keine Spieler im Spiel {$this->event} zugeteilt!</div>";
            return null;
        }
    }

    /**
     * Returns all player of a event
     * @param
     * @return playerList[]
     */
    public function getPlayerList() {
        return $this->playerList;
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
            } else {
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
    public function getLotteryNr($event, $round) {
        $this->history = $this->mysqlAdapter->getHistory($event, $round);
        if (!empty($this->history)) {
            $this->lotteryNr = preg_split("/,/", ($this->history->getNumbers()), -1, PREG_SPLIT_NO_EMPTY);
            if (!empty($this->lotteryNr) && is_array($this->lotteryNr)) {
                return $this->lotteryNr;
            } else {
                return null;
            }
        }
    }

    //Setzt Player
    public function getWinnerList() {
        return $this->winnerList;
    }

    //Holt Erstell Datum/Zeit
    public function getPriceList() {
        return $this->priceList;
    }

    //Holt Erstell Datum/Zeit
    public function setPrice($name, $player, $line) {
        $price = new Price(null, $name, $player, $this->event, $this->round, $line);
        $this->mysqlAdapter->createPrice($price);
        $this->priceList[] = $price;
    }
    
    //ergänzt gewinn mit preis
    public function setPriceWin($name, $player, $event, $round, $line) {
        $price = new Price(null, $name, $player, $event, $round, $line);
        $this->mysqlAdapter->updatePrice($price);
        print_r($price);
        //$this->priceList[] = $price;
    }

    //Holt Aktuallisierungs Datum/Zeit
    public function getUpdateOn() {
        return $this->update_on;
    }
    /**
     * Checks if someone has won
     * @return winnerList[]
     */
    function checkWin() {
        foreach ($this->cardList as $card) {
            $line1 = preg_split("/,/", ($card->getLine1()), -1, PREG_SPLIT_NO_EMPTY);
            $line2 = preg_split("/,/", ($card->getLine2()), -1, PREG_SPLIT_NO_EMPTY);
            $line3 = preg_split("/,/", ($card->getLine3()), -1, PREG_SPLIT_NO_EMPTY);
            $countL1 = 0;
            $countL2 = 0;
            $countL3 = 0;
            $name = "TestPreis";
            foreach ($this->lotteryNr as $winNr) {
                foreach ($line1 as $nr) {
                    if ($nr == $winNr) {
                        ++$countL1;
                    }
                    if ($countL1 == 5) {
                        $winnerId = $card->getPlayer();
                        foreach ($this->playerList as $player) {
                            if ($winnerId == $player->getId()) {
                                $this->winnerList[] = $player->getFirstname();
                                //Überprüfen ob er bereits gewonnen hat in dieser Runde
                                if ($this->mysqlAdapter->checkPrice($winnerId, $this->event, $this->round, 1) == false) {
                                    $this->setPrice(null, $winnerId, 1);
                                }
                            }
                        }
                        break;
                    }
                }
                foreach ($line2 as $nr) {
                    if ($nr == $winNr) {
                        ++$countL2;
                    }
                    if ($countL2 == 5) {
                        $winnerId = $card->getPlayer();
                        foreach ($this->playerList as $player) {
                            if ($winnerId == $player->getId()) {
                                $this->winnerList[] = $player->getFirstname();
                                //Überprüfen ob er bereits gewonnen hat in dieser Runde
                                echo "scheisse is das";
                                if ($this->mysqlAdapter->checkPrice($winnerId, $this->event, $this->round, 2) == false) {
                                    $this->setPrice(null, $winnerId, 2);
                                }
                            }
                        }
                        break;
                    }
                }
                foreach ($line3 as $nr) {
                    if ($nr == $winNr) {
                        ++$countL3;
                    }
                    if ($countL3 == 5) {
                        $winnerId = $card->getPlayer();
                        foreach ($this->playerList as $player) {
                            if ($winnerId == $player->getId()) {
                                $this->winnerList[] = $player->getFirstname();
                                //Überprüfen ob er bereits gewonnen hat in dieser Runde
                                if ($this->mysqlAdapter->checkPrice($winnerId, $this->event, $this->round, 3) == false) {
                                    $this->setPrice(null, $winnerId, 3);
                                }
                            }
                        }
                        break;
                    }
                }
            }
        }

return $this->winnerList;
 
    }

}
