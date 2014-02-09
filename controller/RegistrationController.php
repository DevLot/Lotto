<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'config/config.php';

include_once 'model/Registration.php';
include_once 'model/Event.php';
include_once 'model/Player.php';

include_once 'view/View.php';
include_once 'view/registration/RegistrationView.php';
include_once 'view/registration/RegistrationDetailView.php';

/**
 * Registration controller
 */
class RegistrationController extends Controller {

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $view = new RegistrationView();
        $view->assign('eventlist', $this->mysqlAdapter->getOpenEvents());
        $view->display();
    }

    protected function show() {
        $event = $this->mysqlAdapter->getEvent($this->resourceId);
        if (!empty($event)) { // Event with transmitted ID was found
            $view = new RegistrationDetailView();

            $view->assign('playerlist', $this->mysqlAdapter->getPlayers());
            $view->assign('regplayerlist', $this->mysqlAdapter->getRegistrationPlayers($event->getId()));
            $view->assign('event', $event);

            $view->display();
        }
    }

    protected function init() {

        $view = new RegistrationFormView();
        $view->display();
    }

    protected function create() {

        //Create registration from form
        $registration = new Registration(null, $_POST['player'], $_POST['event']);
        $this->mysqlAdapter->createRegistration($registration);
    }

    protected function edit() {
        $registration = $this->mysqlAdapter->getRegistration($eventId);
        if (!empty($registration)) { // Registration with transmitted ID was found
            $view = new RegistrationFormView();
            $view->assign('registration', $registration);
            $view->display();
        }
    }

    /**
     * Set the registrations from form
     */
    protected function update() {

        //Add or remove registration
        if (!empty($_POST['function']) && !empty($_POST['player']) && !empty($_POST['event'])) {
            $registration = new Registration(null, $_POST['player'], $_POST['event']);
            if ($_POST['function'] == "add") { //Add player to registration
                $this->mysqlAdapter->setRegistration($registration);
            } elseif ($_POST['function'] == "del") {//Remove player to registration
                $this->mysqlAdapter->deleteRegistration($registration);
            }
        }
    }

}
