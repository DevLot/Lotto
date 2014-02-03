<?php

//include_once 'lib/CSVAdapter.php';
include_once 'controller/Controller.php';
//include_once 'model/Event.php';
//include_once 'model/MusicEvent.php';
//include_once 'model/Artist.php';
include_once 'view/View.php';
include_once 'view/login/LoginView.php';

class LoginController extends Controller {

//    private $csvAdapter;

    function __construct() {
//        $this->csvAdapter = new CSVAdapter("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.csv");
    }

    protected function index() {
//        $eventList = $this->csvAdapter->getEventList();
  
        
        $view = new LoginView();
//        $view->assign('list', $eventList);
        $view->display();
    }

    protected function show() {
        echo "not implemented";
    }

    protected function init() {
           
    echo "not implemented";
   
   
    }

    protected function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $username = $_POST['username'];
      $password = $_POST['password'];

 

      // Benutzername und Passwort werden überprüft
      if ($username == 'fabingo' && $password == '123') {
       $_SESSION['login'] = true;

       // Weiterleitung zur geschützten Startseite
       

       header('Location: http://lotto.local/home');
       exit;
       } else {
           header('Location: http://lotto.local');
            
       exit;
       }
      }
    }

}

