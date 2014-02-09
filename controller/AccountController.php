<?php

include_once 'controller/Controller.php';
include_once 'view/View.php';
include_once 'view/account/AccountView.php';

class AccountController extends Controller {

    function __construct() {
        
    }

    protected function index() {
        $view = new AccountView(); //Initiate a new account view
        $view->display(); //Display account view
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
