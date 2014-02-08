<?php

class CardDetailView extends View {

    public function display() {

        $card = $this->vars['card'];
        $playerlist = $this->vars['playerlist'];

        echo '<div class="subcontrol"><div class="button"><a href="/card/">Übersicht</a></div>';
        echo '<div class="button"><a href="/card/' . $card->getId() . '/edit">Bearbeiten</a></div>';
        echo '<div class="button"><a href="/card/'.$card->getId().'/delete">Löschen</a></div></div>';
        echo '<div class = "card">
        <table>
       
        <tr><td>'.$card->getLine1().'</td></tr>
        <tr><td>'.$card->getLine2().'</td></tr>
        <tr><td>'.$card->getLine3().'</td></tr>
        </table>';
        foreach($playerlist as $player){ 
            
            if ($player->getId() == $card->getPlayer()) {
                echo '<div class = "number">Spielkartenhalter: ';
                echo $player->getFirstname(); 
                echo ' ';
                echo $player->getSurname();
                echo '</div>';
            } 
        } 
        echo '<div class = "number">' . $card->getCardnr() . '</div>
        </div>';
    }

}
