<?php

class GamePlayView extends View {

    public function display() {

        $event = $this->vars['event'];
        $game = $this->vars['game'];
        $playerlist = $this->vars['playerlist'];
        $cardlist = $this->vars['cardlist'];

        $lotterynrs = $game->getLotteryNr($event->getId(), $game->getRound());


        echo "<script>
 
               function setnr(val) {                    
                    $.ajax({
                        url: '" . $event->getId() . "/update',
                        type: 'POST',
                        data: {number:val,
                                event:" . $event->getId() . ",
                                    round:" . $game->getRound() . "}, 
                        success: function (result) {
                          
                           location.reload();
                        }
                    });  

                     }
                     

                function endround() {                    
                                    $.ajax({
                                        url: '" . $event->getId() . "/update',
                                        type: 'POST',
                                        data: {endround:'true',
                                         event:" . $event->getId() . ",
                                             round:" . $game->getRound() . "}, 
                                        success: function (result) {
                                         
                                          location.reload();
                                        }
                                    });  

                                     }
                                     
                   function endgame() {                    
                                    $.ajax({
                                        url: '" . $event->getId() . "/update',
                                        type: 'POST',
                                        data: {endgame:'true',
                                         event:" . $event->getId() . ",
                                             round:" . $game->getRound() . "}, 
                                        success: function (result) {
                                          alert('Spiel wurde beendet');
                                          window.location.replace('../home');
                                        }
                                    });  
                                    }
                                    
                   function stop(){
                        Check = confirm('Spiel beenden?');
                        if(Check == true){
                            endgame();
                        };

                                     } 
            </script>";



        echo '<div class="subcontrol">
                    <div class="button"><a href="#" onclick="stop()">Spiel stoppen</a></div><div class="button"><a href="#" onclick="endround()">Nächste Serie</a></div>             
                </div>

                <div class="game">
                        <div class="name">';
        echo $event->getName();
        echo '</div>
                    <!--<div class="time">Seit Spielbeginn: ';
        echo $game->getStarttime();
        echo '</div>-->
                    <div class="set">Aktuelles Set: ';
        echo $game->getRound();
        echo '</div><div class="title">Bitte Zahl eingeben:</div>
                    <div class="number-input">';



        for ($i = 1; $i <= 100; $i++) {
            //Überpüft ob gleiche Nummer bereits gezogen ist
            if (isset($lotterynrs)) {
                if (in_array($i, $lotterynrs)) {
                    echo "<div class='number checked'>";
                    echo $i;
                    echo "</div>";
                } else {
                    echo "<a href ='#' onclick='setnr(" . $i . ")'><div class='number'>";
                    echo $i;
                    echo "</div></a>";
                }
            } else {
                echo "<a href ='#' onclick='setnr(" . $i . ")'><div class='number'>";
                echo $i;
                echo "</div></a>";
            }
        }



        echo ' </li>
                    </div>

                    <div class="title">Gezogene Zahlen</div>
                     <div class="set-number">';
        print_r($game->getLotteryNr($event->getId(), $game->getRound()));
        echo '</div>

                    <div class="title">Angemeldete Spieler</div>';
        foreach ($playerlist as $player) {
            echo '<div class="player">';
            echo $player->getFirstname();
            echo ' ';
            echo $player->getSurname();
            echo '</div>';
        }
        echo '<div class="title">Registrierte Karten</div>';
        foreach ($cardlist as $card) {
            echo '<div class="player">';
            echo $card->getCardnr();
            echo '</div>';
        }
        echo '</div>';
    }

}
