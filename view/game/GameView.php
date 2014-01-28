<?php

class CardView extends View {

    public function display() {
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
            . "<td>" . $card->getPlayer() . "</td>";
        }
        echo '</tr></tbody></table></div>';
    }

    public function newform() {
        include 'form.php';
    }

}
