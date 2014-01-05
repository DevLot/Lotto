<?php


include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'config/config.php';
include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';

include_once 'model/Card.php';
include_once 'view/View.php';
include_once 'view/card/CardView.php';

class CardController extends Controller {
    
    private $mysqlAdapter;
    
    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    
     protected function index() {
     $view = new CardView();
     $view->assign('cardlist', $this->mysqlAdapter->getCards());
     $view->display();

    }
      
    protected function show() {
        $card = $this->mySqlAdapter->getCard($this->resourceId);
        echo $card;
        if (!empty($card)) { // Card with transmitted ID was found
            $view = new CardDetailView();
            $view->assign('card', $card);
            $view->display();
        }
    }

    protected function init() {

        $view = new CardView();
        $view->newform();
    }

    protected function create() {
        
        $card = new Card($_POST['cardnr'],$_POST['line1'],
                $_POST['line2'],$_POST['line3'],$_POST['player']);
                       
        $this->mysqlAdapter->createCard($card);
 

    }

}

