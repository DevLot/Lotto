<?php

class GamePlayView extends View {

    public function display() {

        $event = $this->vars['event'];
        $game = $this->vars['game'];
        $playerlist = $this->vars['playerlist'];
        $cardlist = $this->vars['cardlist'];
       
        $pricesopenlist = $this->vars['pricesopenlist'];

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

                       function ackwin(playerid) {  
                       
                   
                       
                                    var str1 = '#player';
                                    var str2 = playerid;
                                    var res = str1.concat(str2);
                                   
                                   var val = $(res).val();
                                        $.ajax({
                                        url: '" . $event->getId() . "/update',
                                        type: 'POST',
                                        data: {setprice:'true',
                                                event:" . $event->getId() . ",
                                                round:" . $game->getRound() . ",
                                                player:playerid,
                                                price:val}, 
                                        success: function (result) {
                                           location.reload(); 
                                          
                                        }
                                    });  
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
                    </div>';
        
        echo '<div class="title">Gewinner</div>';
            foreach ($pricesopenlist as $winnerid) {
            echo '<div class="infobox warning">Bitte Gewinner bestätigen!</div>';
            echo '<div class="price-input">';
                foreach ($playerlist as $player) {
                    if ($winnerid->getPlayer() == $player->getId()) {
                        echo $player->getFirstname();
                        echo " ";
                        echo $player->getSurname();
                        echo "<br />";
                    }
                    
                }
            echo ' ';
            //echo $winner->getSurname();
            echo '<input type="text" id="player'.$winnerid->getPlayer().'"></input>
                <a href="#" onclick="ackwin('.$winnerid->getPlayer().')">Preis/Gewinn bestätigen</a></div>';
        }

             echo'       <div class="title">Gezogene Zahlen</div>
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
