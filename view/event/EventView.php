<?php

class EventView extends View {

    public function display() {


        //Button and th of table
        include 'table_top.php';

        foreach ($this->vars['eventlist'] as $event) {

            echo '<tr class="clickableRow" href="/event/' . $event->getId() . '"><td>
                <a href="/event/' . $event->getId() . '/edit"><img src="/images/icon_write_full.png" height="14" /></a>
               <a href="/event/' . $event->getId() . '/delete"> <img src="/images/icon_del_full.png" height="14" /></a></td>' .
            "<td>" . $event->getName() . "</td>" .
            "<td>" . $event->getOrganizer() . "</td>" .
            "<td>" . $event->getLocation() . "</td></tr>";
        }
        echo '</tr></tbody></table></div>';
    }

    public function newform() {
        include 'form.php';
    }

}
