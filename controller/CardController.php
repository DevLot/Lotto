<?php

include_once 'config/config.php';
include_once 'model/Card.php';
include_once 'lib/MySqlAdapter.php';

class CardController {
    
    private $mysqlAdapter;
    
    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    
    function getLine1() {
       $list = $this->mysqlAdapter->getCard();
       var_dump($list);
       return $list;
       
    }
}

