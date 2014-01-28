<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'model/Event.php';
//include_once 'model/Event.php';
include_once 'view/View.php';
include_once 'view/game/GameView.php';
include_once 'view/game/GamePlayView.php';

class GameController extends Controller {

    private $mysqlAdapter;

    function __construct() {
       $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
//        $eventList = $this->csvAdapter->getEventList();
        $view = new GameView();
        $view->assign('eventlist', $this->mysqlAdapter->getEvents());
        $view->display();
    }

    protected function show() {
        $event = $this->mysqlAdapter->getEvent($this->resourceId);
        if (!empty($event)) { // Event with transmitted ID was found
            $view = new GamePlayView();
            $view->assign('event', $event);
            $view->display();
        }
    }

    protected function init() {

    }

    protected function create() {
     
        
    }
    
        protected function edit() {
       
    }

    protected function delete() {
      
    }
   protected function update() {

    }

}

