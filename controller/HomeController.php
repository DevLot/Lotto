<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'view/View.php';
include_once 'view/home/HomeView.php';

class HomeController extends Controller {

//    private $csvAdapter;

    function __construct() {
//        $this->csvAdapter = new CSVAdapter("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.csv");
    }

    protected function index() {
//        $eventList = $this->csvAdapter->getEventList();
        $view = new HomeView();
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
        echo "not implemented";
    }

}

