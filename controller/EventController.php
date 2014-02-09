<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'model/Event.php';
include_once 'view/View.php';
include_once 'view/event/EventView.php';
include_once 'view/event/EventDetailView.php';
include_once 'view/event/EventFormView.php';

class EventController extends Controller {

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $view = new EventView();
        $view->assign('eventlist', $this->mysqlAdapter->getEvents());
        $view->display();
    }

    protected function show() {
        $event = $this->mysqlAdapter->getEvent($this->resourceId);
        if (!empty($event)) { // Event with transmitted ID was found
            $view = new EventDetailView();
            $view->assign('event', $event);
            $view->display();
        }
    }

    protected function init() {
        $view = new EventFormView();
        $view->display();
    }

    protected function create() {
        $event = new Event(null, $_POST['name'], $_POST['date'], $_POST['location'], $_POST['organizer']);

        $this->mysqlAdapter->createEvent($event);

        echo '<p>Eintrag erfolgreich!</p>
        <div class="subcontrol"><div class="button"><a href="/event">Danke!</a></div></div>';
    }

    protected function edit() {
        $event = $this->mysqlAdapter->getEvent($this->resourceId);

        if (!empty($event)) { // Event with transmitted ID was found
            $view = new EventFormView();
            $view->assign('event', $event);
            $view->display();
        }
    }

    protected function delete() {
        $player = $this->mysqlAdapter->getEvent($this->resourceId);
        if (!empty($event)) { // Player with transmitted ID was found
            $view = new EventDetailView();
            $view->assign('event', $event);
            $view->deleteform();
        }
    }

    protected function update() {

        $event = new Event($_POST['id'], $_POST['name'], $_POST['date'], $_POST['location'], $_POST['organizer']);

        $this->mysqlAdapter->updateEvent($event);

        echo '<p>Update erfolgreich!</p>
       <div class="subcontrol"> <div class="button"><a href="/event">Danke!</a></div></div>';
    }

}
