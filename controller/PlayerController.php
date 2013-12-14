<?php

include_once 'lib/MysqlAdapter.php';
include_once 'controller/Controller.php';
//include_once 'model/Event.php';
//include_once 'model/MusicEvent.php';
include_once 'model/Player.php';
include_once 'view/View.php';
include_once 'view/player/PlayerView.php';

class PlayerController extends Controller {

    private $mysqlAdapter;

    function __construct() {
      $this->mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $view = new PlayerView();
        $view->assign('playerlist', $this->mysqlAdapter->getPlayers());
        $view->display();
    }

    protected function show() {
        echo "shoooww is not implemented";
    }

    protected function init() {

        $view = new PlayerView();
        $view->newform();
    }

    protected function create() {
        
        $player = new Player($_POST['firstname'],$_POST['surname'],
                $_POST['birthdate'],$_POST['address'],$_POST['zipcode'],
                $_POST['city'],$_POST['phone'],$_POST['mobile'],$_POST['mail']);
        
              
        $firstname = $player->getFirstname();
        $surname = $player->getSurname();
        $birthdate = $player->getBirthdate();
        $address = $player->getAddress();
        $zipcode = $player->getZipcode();
        $city = $player->getCity();
        $phone = $player->getPhone();
        $mobile = $player->getMobile();
        $mail = $player->getMail();
                
        $this->mysqlAdapter->createPlayer($firstname,$surname,$birthdate,$address,$zipcode,$city,$phone,$mobile,$mail);
      
           
    }
   

}

