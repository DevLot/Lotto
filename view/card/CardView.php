<?php

class CardView extends View {

    public function display() {
        echo '<div class="subcontrol"><div class="button"><a href="/card/new">Neue Karte</a></div>
                </div><div class="list"><table>
                <tbody><tr><th></th>
                 <th>Kartennummer</th><th>Zugewiesener Spieler</th>
                </tr>';
      
        foreach ($this->vars['cardlist'] as $card) {
     
            echo '<tr><td><input type="checkbox" /> &#8239;
                <img src="/images/icon_write_full.png" height="14" />
                <img src="/images/icon_del_full.png" height="14" /></td>
                    ' ."<td>" . $card->getCardnr() . "</td>"
                     ."<td>" . $card->getPlayer() . "</td>";
        }
        echo '</tr></tbody></table></div>';
    }
    
      public function newform() {
        include 'form.php';
    }

}
