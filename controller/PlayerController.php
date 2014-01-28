<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'config/config.php';
include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';

include_once 'model/Player.php';
include_once 'view/View.php';
include_once 'view/player/PlayerView.php';
include_once 'view/player/PlayerDetailView.php';
include_once 'view/player/PlayerFormView.php';

class PlayerController extends Controller {

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $view = new PlayerView();
        $view->assign('playerlist', $this->mysqlAdapter->getPlayers());
        $view->display();
    }

    protected function show() {

        $player = $this->mysqlAdapter->getPlayer($this->resourceId);
        if (!empty($player)) { // Player with transmitted ID was found
            $view = new PlayerDetailView();
            $view->assign('player', $player);
            $view->display();
        }

//        $this->mysqlAdapter->getPlayers();
//        $this->mysqlAdapter->getPlayer($id);
    }

    protected function init() {

        $view = new PlayerFormView();
        $view->display();
    }

    protected function create() {

        $player = new Player(null, $_POST['firstname'], $_POST['surname'], $_POST['birthdate'], $_POST['address'], $_POST['zipcode'], $_POST['city'], $_POST['phone'], $_POST['mobile'], $_POST['mail']);

        $this->mysqlAdapter->createPlayer($player);
        
         echo '<p>Neuer Eintrag erfolgreich!</p>
        <div class="button"><a href="/player">Danke!</a></div>';
    }

    protected function edit() {
        $player = $this->mysqlAdapter->getPlayer($this->resourceId);

        if (!empty($player)) { // Player with transmitted ID was found
            $view = new PlayerFormView();
            $view->assign('player', $player);
            $view->display();
        }
    }

    protected function delete() {
        $player = $this->mysqlAdapter->getPlayer($this->resourceId);
        if (!empty($player)) { // Player with transmitted ID was found
            $view = new PlayerDetailView();
            $view->assign('player', $player);
            $view->deleteform();
        }
    }

    protected function update() {

        $player = new Player(null,$_POST['firstname'],$_POST['surname'],
                $_POST['birthdate'],$_POST['address'],$_POST['zipcode'],
                $_POST['city'],$_POST['phone'],$_POST['mobile'],$_POST['mail'],$_POST['status']);
                       
        $this->mysqlAdapter->updatePlayer($player);
        
  
         echo '<p>Update erfolgreich!</p>
        <div class="button"><a href="/player">Danke!</a></div>';
    }

}
