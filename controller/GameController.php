<?php

include_once 'lib/MySqlAdapter.php';
include_once 'config/config.php';

include_once 'controller/Controller.php';

include_once 'model/Card.php';
include_once 'model/Event.php';
include_once 'model/History.php';
include_once 'model/Player.php';
include_once 'model/Price.php';
include_once 'model/Registration.php';
include_once 'model/Game.php';

include_once 'view/View.php';
include_once 'view/card/CardView.php';

class GameController extends Controller{

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        
    }

    public function show() {
        
        $game = new Game("3");
        echo $game->getStartTime()," ";

        $playerList = $game->getPlayerList();
        if(!empty($playerList)) {
            foreach($playerList as $player) {
                echo "Spieler:{$player->getFirstname()} {$player->getSurname()}, Geb: {$player->getBirthdate()}";
            }
        } else {
            return null;
        }
        $cardList = $game->getCardList();
        
        if(!empty($cardList)) {
            echo "True";
            foreach($cardList as $card) {
                if(!empty($card) && is_array($card)) {
                    echo "Super";
                }
                if(!empty($card) && is_object($card)) {
                    echo "Bad";
                }
                echo "1 Linie:{$card->getLine1()}";
            }
        } else {
            return null;
        }
     
        
    }

    protected function init() {
        
    }

    protected function create() {

        $game = new Game($_POST['event']);

        $this->mysqlAdapter->createGame($game);
    }

}
