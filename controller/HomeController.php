<?php

include_once 'lib/MySqlAdapter.php';
include_once 'controller/Controller.php';
include_once 'view/View.php';
include_once 'view/home/HomeView.php';


/**
 * Home controller
 */
class HomeController extends Controller {


    function __construct() {

    }

    protected function index() {
        $view = new HomeView();
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

