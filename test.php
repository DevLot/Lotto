<!doctype html>
<meta charset="UTF-8"> 

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

                <div class="subcontrol">
                    <div class="button"><a href="/game/stop">Spiel stoppen</a></div><div class="button"><a href="/game/nextset">Nächste Serie</a></div>             
                </div>

                <div class="game">
                    <div class="name">Eventname</div>
                    <div class="time">Seit Spielbeginn: 1h 32min 23sec</div>
                    <div class="set">Aktuelles Set: 2</div>
                    <div class="title">Bitte Zahl eingeben:</div>

                   
                    <div class="number-input">
                                                
                        <?php
                        for ($i = 1; $i <= 100; $i++) {
                            echo "<a href='".$i."'><div class='number'>";
                            echo $i;
                            echo "</div></a>";
                        }
                        ?>
                        </li>
                    </div>

                    <div class="title">Gezogene Zahlen</div>
                     <div class="set-number">Serie 1: 34 / 32 / 32 / 33 / 23 / 29 /34 / 43</div>
                    <div class="set-number">Serie 2: 34 / 32 / 32 / 33 / 23 / 29 /34 / 43</div>
                    <div class="set-number">Serie 3: 34 / 32 / 32 / 33 / 23 / 29 /34 / 43</div>

                    <div class="title">Angemeldete Spieler</div>
                     <div class="player">Stefan Meier: 4343</div>  
                      <div class="player">Phillip Meier: 4367,5454</div>


                </div></div>

            <div id="footer">
                by Oliver und Fabian
            </div>
        </div>

    </body>
</html>