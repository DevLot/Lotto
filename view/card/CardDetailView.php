<?php

class CardDetailView extends View {

    public function display() {

        $card = $this->vars['card'];

        echo '<div class="subcontrol"><div class="button"><a href="/card/">Übersicht</a></div>';
        echo '<div class="button"><a href="/card/' . $card->getId() . '/edit">Bearbeiten</a></div>';
        echo '<div class="button"><a href="/card/'.$card->getId().'/delete">Löschen</a></div></div>';
        echo '<div class = "card">
        <table>
        <tr><td>'.$card->getLine1().'</td></tr>
        <tr><td>'.$card->getLine2().'</td></tr>
        <tr><td>'.$card->getLine3().'</td></tr>
        </table>
        <div class = "number">Kartennummer ' . $card->getCardnr() . '</div>
        </div>';
    }

}
