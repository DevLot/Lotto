<?php

include_once 'config/config.php';
include_once 'model/Card.php';
include_once 'lib/MySqlAdapter.php';

class CardController extends Controller {
    
    private $mySqlAdapter;
    
    function __construct() {
        $this->mySqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    //Erstellt neue Spielkarte
    function create($card) {
        
        $cardnr = $card->getCardnr();
        $line1 = $card->getLine1();
        $line2 = $card->getLine2();
        $line3 = $card->getLine3();
        $player = $card->getPlayer();
        
        $this->mySqlAdapter->createCard($cardnr,$line1,$line2,$line3,$player);
    }
    //Aktuallisiert Spielkarte
    function update($card) {
        
    }

}

