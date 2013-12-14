<?php

class PlayerView extends View {

    public function display() {

        //Button and th of table
        include 'table_top.php';

        foreach ($this->vars['playerlist'] as $player) {

            echo '<tr>' .
            '<td>' . $player->firstname() . '</td>' .
            '<td>' . $player->surname() . '</td>' .
            '<td>' . $player->birthdate() . '</td>' .
            '<td>' . $player->address() . '</td>' .
            '<td>' . $player->zipcode() . '</td>' .
            '<td>' . $player->zipcode() . '</td>' .
            '<td>' . $player->phone() . '</td>' .
            '<td>' . $player->mobile() . '</td>' .
            '<td>' . $player->mail() . '</td>' .
            '<td>28,32,32,32</td>';
        }
        echo '</tr></tbody></table>';
    }

    public function newform() {
        include 'form.php';
    }

}
