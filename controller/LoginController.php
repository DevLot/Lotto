<?php

include_once 'controller/Controller.php';

include_once 'view/View.php';
include_once 'view/login/LoginView.php';

/**
 * Login controller
 * 
 */
class LoginController extends Controller {

    function __construct() {
        
    }

    protected function index() {

        $view = new LoginView();
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

            //Get credentials from login
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check credentials if matched
            if ($username == 'fabingo' && $password == '123') {
                //Start a session
                $_SESSION['login'] = true;

                // Redirect to the protected site
                header('Location: http://lotto.local/home');
                exit;
            } else {
                //Redirect to the login site
                header('Location: http://lotto.local');
                exit;
            }
        }
    }

}
