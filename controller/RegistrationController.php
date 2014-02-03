<?php


include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'config/config.php';
include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';

include_once 'model/Registration.php';
include_once 'view/View.php';
//include_once 'view/card/CardView.php';
//include_once 'view/card/CardDetailView.php';
//include_once 'view/card/CardFormView.php';

class RegistrationController extends Controller {
    
    private $mysqlAdapter;
    
    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    
     protected function index() {
     $view = new RegistrationView();
     $view->assign('registrationlist', $this->mysqlAdapter->getRegistrations());
     $view->display();

    }
      
    protected function show() {
        $registration = $this->mysqlAdapter->getRegistration($eventId);
        if (!empty($registration)) { // Registration with transmitted ID was found
            $view = new RegistrationDetailView();
            $view->assign('registration', $registration);
            $view->display();
        }
    }

    protected function init() {

        $view = new RegistrationFormView();
        $view->display();
    }

    protected function create() {
        
        $registration = new Registration(null,$_POST['player'],$_POST['event']);
                       
        $this->mysqlAdapter->createRegistration($registration);
 

    }
    
    protected function edit() {
        $registration = $this->mysqlAdapter->getRegistration($eventId);
        if (!empty($registration)) { // Card with transmitted ID was found
            $view = new RegistrationFormView();
            $view->assign('registration', $registration);
            $view->display();
        }
    }
    
    protected function delete() {
        $this->mysqlAdapter->deletRegistration($_POST['id']);
    }

}

