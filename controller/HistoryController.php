<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'model/History.php';
include_once 'view/View.php';

/**
 * History controller
 */
class HistoryController extends Controller {

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MySqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
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
        //Create history from GET
        $history = new History(null, $_POST['event'], $_POST['set'], $_POST['numbers']);
        $this->mysqlAdapter->setHistory($history);
    }

}
