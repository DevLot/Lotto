<?php

class CardView extends View {

    public function display() {

        $playerlist = $this->vars['playerlist'];


        echo '<div class="subcontrol"><div class="button"><a href="/card/new">Neue Karte</a></div>
                </div><div class="list"><table>
                <tbody><thead><th></th>
                 <th>Kartennummer</th><th>Zugewiesener Spieler</th>
                </thead><tbody>';

        foreach ($this->vars['cardlist'] as $card) {

            echo '<tr class="clickableRow" href="/card/' . $card->getId() . '"><td>'
            . '<a href="/card/' . $card->getId() . '/edit"><img src="/images/icon_write_full.png" height="14" /></a>
               <a href="/card/' . $card->getId() . '/delete"> <img src="/images/icon_del_full.png" height="14" /></a></td>' .
            "<td>" . $card->getCardnr() . "</td>"
            . "<td>";

            foreach ($playerlist as $player) {

                if ($player->getId() == $card->getPlayer()) {
                    echo $player->getFirstname();
                    echo ' ';
                    echo $player->getSurname();
                }
            }


            echo "</td>";
        }
        echo '</tr></tbody></table></div>';
    }

    public function newform() {
        include 'form.php';
    }

}
