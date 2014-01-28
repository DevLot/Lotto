<?php

class GamePlayView extends View {

    public function display() {

        $event = $this->vars['event'];

        echo '
                <div class="subcontrol">
                    <div class="button"><a href="/game/stop">Spiel stoppen</a></div><div class="button"><a href="/game/nextset">Nächste Serie</a></div>             
                </div>

                <div class="game">
                    <div class="name">Eventname</div>
                    <div class="time">Seit Spielbeginn: 1h 32min 23sec</div>
                    <div class="set">Aktuelles Set: 2</div>
                    <div class="title">Bitte Zahl eingeben:</div>

                   
                    <div class="number-input">';

        for ($i = 1; $i <= 100; $i++) {
            echo "<a href='" . $i . "'><div class='number'>";
            echo $i;
            echo "</div></a>";
        }

        echo ' </li>
                    </div>

                    <div class="title">Gezogene Zahlen</div>
                     <div class="set-number">Serie 1: 34 / 32 / 32 / 33 / 23 / 29 /34 / 43</div>
                    <div class="set-number">Serie 2: 34 / 32 / 32 / 33 / 23 / 29 /34 / 43</div>
                    <div class="set-number">Serie 3: 34 / 32 / 32 / 33 / 23 / 29 /34 / 43</div>

                    <div class="title">Angemeldete Spieler</div>
                     <div class="player">Stefan Meier: 4343</div>  
                      <div class="player">Phillip Meier: 4367,5454</div>


                </div></div>';
    }

}
