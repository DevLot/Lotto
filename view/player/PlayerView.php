<?php

class PlayerView extends View {

    public function display() {

        //Button and th of table
        include 'table_top.php';

        foreach ($this->vars['playerlist'] as $player) {

            echo '<tr><td><input type="checkbox" /> &#8239;
                <img src="/images/icon_write_full.png" height="14" />
                <img src="/images/icon_del_full.png" height="14" /></td>
                    ' .
            "<td>" . $player->getFirstname() . "</td>" .
            "<td>" . $player->getSurname() . "</td>" .
            "<td>" . $player->getBirthdate() . "</td>" .
            "<td>" . $player->getAddress() . "</td>" .
            "<td>" . $player->getZipcode() . "</td>" .
            "<td>" . $player->getCity() . "</td>" .
            "<td>" . $player->getPhone() . "</td>" .
            "<td>" . $player->getMobile() . "</td>" .
            "<td>" . $player->getMail() . "</td>" .
            "<td>28,32,32,32</td>";
        }
        echo '</tr></tbody></table>';
    }

    public function newform() {
        include 'form.php';
    }

}
