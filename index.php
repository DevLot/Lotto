<?php
session_start();
?>

<!doctype html>

<?php
include_once 'config/config.php';
?>

<html lang="de">
    <head>
        <title>Fabingo</title>
        <meta name="description" content="Fabingo zum Lotto verbessern">
        <meta name="author" content="Fabingo Team">
        <meta charset="UTF-8"> 
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="/css/application.css">

        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,500' rel='stylesheet' type='text/css'>

        <script src="/js/vendor/jquery-1.8.3.min.js"></script>
        <script src="/js/application.js"></script>

    </head>
    <body>
        <div id="header">
            <div class="logo">
                <a href="/home"><div class="logo">FaBingo</div></a>
            </div>

            <div class="button"><a href="/logout">Logout</a></div>

        </div>

        <div id="wrap">

            <div id="navtree">
                <a href="/home">Start</a> > 
                <a href="<?php echo getCurrentURI(); ?>"><?php echo getCurrentMenu(); ?></a>
                
            </div>


            <div id="content">
                <?php
                $controller = null;
                if (isset($_SESSION['login'])) {


                    switch (getCurrentURI()) {
                        case URI_LOGIN:
                            include_once 'controller/LoginController.php';
                            $controller = new LoginController();
                            break;
                        case URI_HOME:
                            include_once 'controller/HomeController.php';
                            $controller = new HomeController();
                            break;
                        case URI_EVENT:
                            include_once 'controller/EventController.php';
                            $controller = new EventController();
                            break;
                        case URI_PLAYER:
                            include_once 'controller/PlayerController.php';
                            $controller = new PlayerController();
                            break;
                        case URI_CARD:
                            include_once 'controller/CardController.php';
                            $controller = new CardController();
                            break;
                        case URI_ACCOUNT:
                            include_once 'controller/AccountController.php';
                            $controller = new AccountController();
                            break;
                        case URI_GAME:
                            include_once 'controller/GameController.php';
                            $controller = new GameController();
                            break;
                        case URI_REG:
                            include_once 'controller/RegistrationController.php';
                            $controller = new RegistrationController();
                            break;
                        case URI_LOGOUT:
                            session_destroy();
                            header('Location: http://lotto.local');
                            break;

                        default:
                            include_once 'controller/HomeController.php';
                            $controller = new HomeController();
                            break;
                    }
                    if ($controller != null) {
                        $controller->route();
                    }
                } else {

                    include_once 'controller/LoginController.php';
                    $controller = new LoginController();
                    
                    if ($controller != null) {
                        $controller->route();
                    }
                }
                ?>

            </div>

            <div id="footer">
                Developed with &#x2764; by Oliver und Fabian
            </div>
        </div>


    </body>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".clickableRow").click(function() {
                window.document.location = $(this).attr("href");
            });
        });</script>


</html>


<?php

/**
 * @return array containing all menu items in format [base href] => [title]
 */
function getMenu() {
    return array(
        URI_LOGIN => 'Login',
        URI_HOME => 'Home',
        URI_EVENT => 'Veranstaltung',
        URI_PLAYER => 'Spieler',
        URI_CARD => 'Spielkarten',
        URI_ACCOUNT => 'Account',
        URI_GAME => 'Spiel',
        URI_REG => 'Registration',
        URI_LOGOUT => 'Logout'
    );
}

/**
 * @return string the requested menu item URI
 */
function getCurrentURI() {
    $menu = getMenu();
    if (array_key_exists($_SERVER['REQUEST_URI'], $menu)) {
        return $_SERVER['REQUEST_URI'];
    } else {
        foreach (array_keys(getMenu()) as $href) {
            if (preg_match("@^$href@", $_SERVER['REQUEST_URI'])) {
                return $href;
            }
        }
    }
    return key($menu);
}

/**
 * @return string the requested name
 */
function getCurrentMenu() {
    
    
    $uri = getCurrentURI() ;
    $str= ltrim ($uri,'/');
    return ucfirst($str);
}
?>

