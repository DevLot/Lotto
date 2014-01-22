<?php

class CardDetailView extends View {

    public function display() {

        $card = $this->vars['card'];

        echo '<div class="subcontrol"><div class="button"><a href="/card/">Übersicht</a></div>';
        echo '<div class="button"><a href="/card/' . $card->getId() . '/edit">Bearbeiten</a></div>';
        echo '<div class="button"><a href="/card/'.$card->getId().'/delete">Löschen</a></div></div>';
        echo '<div class = "card">
        <table>
        <tr><td>'.$card->getLine1().'</td><td>3</td><td>25</td><td>33</td><td>40</td></tr>
        <tr><td>'.$card->getLine2().'</td><td>7</td><td>20</td><td>24</td><td>55</td></tr>
        <tr><td>'.$card->getLine3().'</td><td>19</td><td>21</td><td>23</td><td>47</td></tr>
        </table>
        <div class = "number">Testcard 293434</div>
        </div>';
    }

}
