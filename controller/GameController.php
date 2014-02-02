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
    private $game;

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

            //Beginn neues Game
             $this->game = new Game($this->resourceId);
            // $this->game->addNumber(56);

            $playerList = $this->game->getPlayerList();
            $cardList = $this->game->getCardList();

            $view->assign('event', $event);
            $view->assign('game', $this->game);
            $view->assign('playerlist', $playerList);
            $view->assign('cardlist', $cardList);

            $view->display();
        }
    }

    public function stop() {

//        if (!empty($this->game)) {
//            $this->game->endRound();
//            $this->game->endGame();
//            echo "Das Spiel wurde beendet";
//        } else {
//            echo "Zu diesem Event läuft gerade kein Spiel";
//        }
    }

    public function update() {
         
        echo "update funzt";
         echo $_POST['event'];
         echo $_POST['endround'];
         
        $game = new Game($_POST['event']);
        
         print_r($game);
        
        //Nummer setzen und auf Gewinne prüfen
        if (!empty($_POST['number'])) {
            $number = $_POST['number'];
            $game->addNumber($number);
            $game->checkWin();
        } elseif (!empty($_POST['endround'])){
            $game->endRound($_POST['event'], $_POST['round']);
        } elseif (!empty($_POST['stop'])){
            $game->endRound($_POST['event'], $_POST['round']);
            $this->game->endGame();
        }
    }

    protected function create() {
        
    }

    protected function init() {
        
    }

}
