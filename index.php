<!doctype html>
<meta charset="UTF-8"> 
<?php include_once 'model/Player.php';
      include_once 'model/Card.php';
      include_once 'config/config.php';
?>
<html lang="de">
    <head>
        <title>Fabingo</title>
        <meta name="description" content="Fabingo zum Lotto verbessern">
        <meta name="author" content="Fabingo Team">
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
                    Home > Start
                </div>
        
                               
                <div id="content">
                    <?php 
                    include_once 'controller/CardController.php';
                        
                        $controller = new CardController();
                        $player = new Player("Dadaa","Best", "2013-12-14", "Musterweg 1", '5400', "Baden", '01234', '56789', "max@muster.ch");
                        $card = new Card(1, array(1,2,3,4,5), array(6,7,8,9,10),array(11,12,13,14,15), $player);

                        $controller->createPlayer($player);
                        $zahl = $controller->getLine1();
                        echo $zahl;
                                                         
                   ?>
                  
                </div>

                <div id="footer">
                    by Oliver und Fabian
                </div>
            </div>

    </body>
</html>