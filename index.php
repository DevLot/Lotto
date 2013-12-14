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
                        $player = new Player("Max","Muster", "2013-12-14", "Musterweg 1", 5400, "Baden", 01234, 56789, "max@muster.ch");
                        $card = new Card(1, array(1,2,3,4,5), array(6,7,8,9,10),array(11,12,13,14,15), $player);
 
                        $zahl = $controller->getLine1();
                        //$zahl = implode($zahl);
                        var_dump($zahl);
                      /*                          
                        $setQuery = sprintf(
                                "use fabingo;
                                INSERT INTO cards (cardnr, line1, line2, line3, player, create_on, update_on)
                                VALUES (1234,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8','Max Muster', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());");
                        $getQuery = sprintf("SELECT line1 FROM fabingo.cards WHERE id=2;");
                        
                        //mysql_query($setQuery);
                        $result = mysql_query($getQuery);
                        echo $result;
                       
                       */
                   ?>
                  
                </div>

                <div id="footer">
                    by Oliver und Fabian
                </div>
            </div>

    </body>
</html>