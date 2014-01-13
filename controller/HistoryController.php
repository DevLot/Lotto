<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'model/History.php';
include_once 'view/View.php';
//include_once 'view/history/HistoryView.php';

class HistoryController extends Controller {

    private $mysqlAdapter;

    function __construct() {
       $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
//        $eventList = $this->csvAdapter->getEventList();
        $view = new HistoryView();
        $view->assign('historylist', $this->mysqlAdapter->getHistory());
        $view->display();
    }

    protected function show() {
        $this->mysqlAdapter->getHistory();
    }

    protected function init() {
        $view = new HistoryView();
        $view->newform();
    }

    protected function create() {
        $event = new Event(null,$_POST['event'],$_POST['set'],$_POST['numbers']);
                       
        $this->mysqlAdapter->setHistory($history);
    }

}

