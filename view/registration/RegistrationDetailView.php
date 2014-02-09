<?php

class RegistrationDetailView extends View {

    public function display() {

        $event = $this->vars['event'];
        $playerlist = $this->vars['playerlist'];
        $regplayerlist = $this->vars['regplayerlist'];

        echo "<script>
 
               function add(val) {                    
                    $.ajax({
                        url: '" . $event->getId() . "/update',
                        type: 'POST',
                        data: {function:\"add\", player:val,
                                event:" . $event->getId() . "}, 
                        success: function () {
                          location.reload(); 
                           
                        }
                    });  

                     }
                     

                function del(val) {                    
                                    $.ajax({
                                 url: '" . $event->getId() . "/update',
                                 type: 'POST',
                                 data: {function:\"del\", player:val,
                                  event:" . $event->getId() . "},
                                    
                                        success: function (result) {
                                         
                                          location.reload();
                                        }
                                    });  

                                     }
 
            </script>";



        echo 'Bitte alle Spieler anwählen, die am Event <strong>';
        echo $event->getName();
        echo '</strong> nicht teilnehmen können<br /><br />

            <div class="list">
            <table>
            <tbody><thead>
            <th></th> 
            <th>Spielername</th>
            <th>Geb.-Datum</th>
            <th>Ort</th>

            </thead>';

        //Array with all player ids
        foreach ($regplayerlist as $regplayer) {
            $regplayerids[] = $regplayer->getId();
        }

        foreach ($playerlist as $player) {

            echo '<tr><td>';



            //Check if a player is registred to the game
            if (in_array($player->getId(), $regplayerids)) {
                echo '<a href="#" onclick="del(' . $player->getId() . ')"><img src="/images/icon_minus_full.png" height="14" /></a>';
            } else {
                echo '<a href="#" onclick="add(' . $player->getId() . ')"> <img src="/images/icon_plus_full.png" height="14" /></a></td>';
            }

            echo "<td>" . $player->getFirstname() . " " . $player->getSurname() . "</td>";
            echo "<td>" . $player->getBirthdate() . "</td>";
            echo "<td>" . $player->getCity() . "</td>";
        }
        echo '</tr></tbody></table></div>';

        echo '<script type="text/javascript">
            jQuery(document).ready(function($) {
      $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
});</script>';
    }

}
