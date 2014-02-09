<?php

class RegistrationView extends View {

    public function display() {

        //Button and th of table
        include 'table_top.php';

        foreach ($this->vars['eventlist'] as $event) {

            echo '<tr class="clickableRow" href="/registration/' . $event->getId() . '">' .
            "<td>" . $event->getName() . "</td>" .
            "<td>" . $event->getOrganizer() . "</td>" .
            "<td>" . $event->getLocation() . "</td></tr>";
        }
        echo '</tr></tbody></table></div>';
    }

}
