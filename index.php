<!doctype html>

﻿<!doctype html>
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
    </head>
    <body>
                <div id="header">
                    <div class="logo">
                        <a href="/home"><img src="/images/logo_site.png" alt="Logo" height="26"/></a>
                    </div>
                    <div class="button"><a href="">Logout</a></div>

                </div>

                <div id="wrap">             

                    <div id="navtree">
                        Home > <?php $currentUri = getCurrentURI(); echo $currentUri; ?>
                    </div>


                    <div id="content">
                        <?php
                                           
                        

                        $controller = null;
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
                            case URI_PLAYER_NEW:
                                include_once 'controller/PlayerNewController.php';
                                $controller = new PlayerNewController();
                                break;
                         
                            case URI_CARD:
                                include_once 'controller/CardController.php';
                                $controller = new CardController();
                                break;
                            case URI_ACCOUNT:
                                include_once 'controller/AccountController.php';
                                $controller = new AccountController();
                                break;
                            default :
                                include_once 'controller/HomeController.php';
                                $controller = new HomeController();
                                break;
                        }
                        if ($controller != null) {
                            $controller->route();
                        }
                        ?>

                    </div>

                    <div id="footer">
                        by Oliver und Fabian
                    </div>
                </div>

                </body>
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
        URI_ACCOUNT => 'Account'
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
?>