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
include_once 'model/MailPrice.php';

include_once 'view/game/GameView.php';
include_once 'view/game/GamePlayView.php';

include_once 'view/View.php';
include_once 'view/card/CardView.php';

/**
 * Game Controller
 * 
 *
 * @author Fabingo Team
 */
class GameController extends Controller {

    private $mysqlAdapter;
    private $game;

    function __construct() {

        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $view = new GameView();
        $view->assign('eventlist', $this->mysqlAdapter->getOpenEvents());
        $view->display();
    }

    protected function show() {
        $event = $this->mysqlAdapter->getEvent($this->resourceId);
        if (!empty($event)) { // Event with transmitted ID was found
            $view = new GamePlayView();

            //Create/Start a new game
            $this->game = new Game($this->resourceId);

            $playerList = $this->game->getPlayerList(); //Get all registred players
            $cardList = $this->game->getCardList(); //Get all registred cards

            $view->assign('event', $event);
            $view->assign('game', $this->game);
            $view->assign('playerlist', $playerList);
            $view->assign('cardlist', $cardList);

            //Get all prices which are not yet assigned 
            $view->assign('pricesopenlist', $this->mysqlAdapter->getPricesOpen($this->resourceId));

            $view->display();
        }
    }

    public function update() {

        $game = new Game($_POST['event']);

        //Set numbers and check win
        if (!empty($_POST['number'])) { //Check if number has been  sent
            $number = $_POST['number'];
            $lotterynr = $game->getLotteryNr($_POST['event'], $_POST['round']);
            $winnernames = $game->addNumber($number);
        } elseif (!empty($_POST['endround'])) { //Check if next set has been initiated
            $game->endRound($_POST['event'], $_POST['round']);
        } elseif (!empty($_POST['endgame'])) { //Check if the game has ended
            $game->endRound($_POST['event'], $_POST['round']);
            $game->endGame();
        } elseif (!empty($_POST['setprice'])) { //Check if price has been setted
            $game->setPriceWin($_POST['price'], $_POST['player'], $_POST['event'], $_POST['round']);
        }
    }

    protected function create() {
        
    }

    protected function init() {
        
    }

    /**
     * Stop the game and inform the players
     * 
     */
    protected function end() {
        $winplayers = $this->mysqlAdapter->getWinPlayers($this->resourceId);
        $event = $this->mysqlAdapter->getEvent($this->resourceId);

        if (!empty($winplayers)) { // Player with transmitted ID was found
            foreach ($winplayers as $winplayer) {
                //Mailtext
                $mailtext = "Herzlichen Glückwunsch " . $winplayer->getFirstname() . ", du hast am " . $event->getName() .
                        " folgenden Preis gewonnen " . $winplayer->getName() . ". Beste Grüsse, das Lotto Team";

                $to = $winplayer->getMail(); //Recipient
                $from = "lottoteam@lotto.local"; //Sender
                $subject = "Lottogewinn im Event " + $event->getName(); //Subject
                mail($to, $subject, $mailtext, "From: $from "); //Send mail with content
            }
        }
    }

}
