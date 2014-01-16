<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'config/config.php';
include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';

include_once 'view/View.php';
include_once 'view/card/CardView.php';


class MatchController {
    
    private $mysqlAdapter;

    function __construct() {
       $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    
    function eventPlayers($event) {
        
        $playerlist[] = $this->mysqlAdapter->getRegistration($event);
        $cardlist = array();
        foreach($playerlist as $player) {
            
           $cardlist[] = $this->mysqlAdapter->getCard($player->getId());
        }
        
       $historylist[] = $this->mysqlAdapter->getHistory($event);
       foreach ($historylist as $history) {
           $numbers = $history->getNumbers();
           $set = $history->getSet();
           
       }
    }
    
    function checkMatch() {
        
        $cardlist[] = $this->mysqlAdapter->getCards();
        foreach($cardlist as $value) {
            $card = $value;
            $line1[] = preg_split(',', ($card->getLine1()), -1, PREG_SPLIT_NO_EMPTY);
            $line2[] = preg_split(',', ($card->getLine2()), -1, PREG_SPLIT_NO_EMPTY);
            $line3[] = preg_split(',', ($card->getLine3()), -1, PREG_SPLIT_NO_EMPTY);
            foreach ($line1 as $number) {
                
                
                
                
            }
        }
        
    

        
        
    }
    
    
    
    
}
