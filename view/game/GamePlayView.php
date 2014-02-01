<?php

class GamePlayView extends View {

    public function display() {

        $event = $this->vars['event'];
        $game = $this->vars['game'];
        $playerlist = $this->vars['playerlist'];
        $cardlist = $this->vars['cardlist'];


        echo '<div class="subcontrol">
                    <div class="button"><a href="/game/stop">Spiel stoppen</a></div><div class="button"><a href="/game/nextset">Nächste Serie</a></div>             
                </div>

                <div class="game">
                        <div class="name">';
        echo $event->getName();
        echo '</div>
                    <div class="time">Seit Spielbeginn: ';
        echo $game->getDuration();
        echo '</div>
                    <div class="set">Aktuelles Set: ';
        echo $game->getRound();
        echo '</div><div class="title">Bitte Zahl eingeben:</div>
                    <div class="number-input">';

        for ($i = 1; $i <= 100; $i++) {
            echo "<a href='" . $i . "'><div class='number'>";
            echo $i;
            echo "</div></a>";
        }

        echo ' </li>
                    </div>

                    <div class="title">Gezogene Zahlen</div>
                     <div class="set-number">';
                     echo $game->getLotteryNr();
                  echo   '</div>

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
