<?php

include_once 'lib/MySqlAdapter.php';
include_once 'view/View.php';

include_once 'config/config.php';

include_once 'controller/Controller.php';

include_once 'model/Card.php';
include_once 'model/Event.php';
include_once 'model/History.php';
include_once 'model/Player.php';
include_once 'model/Price.php';
include_once 'model/Registration.php';
include_once 'model/Game.php';

include_once 'view/game/GameView.php';
include_once 'view/game/GamePlayView.php';

include_once 'view/View.php';
include_once 'view/card/CardView.php';

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

    public function play() {

        $game = new Game(3);
        $playerList = $game->getPlayerList();
        $cardList = $game->getCardList();
        echo $game->addNumber(1);
        echo $game->addNumber(2);
        echo $game->addNumber(3);
        echo $game->addNumber(4);
        echo $game->addNumber(5);
        $game->endRound();
        $game->addNumber(6);
        $game->addNumber(7);
        $game->addNumber(8);
        $game->addNumber(9);
        $game->addNumber(10);
        $game->endRound();
    }

    protected function create() {
        
    }

    protected function init() {
        
    }

}
