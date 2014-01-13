<?php

class EventView extends View {

    public function display() {
        echo '<div class="button"><a href="/event/new">Neuer Event</a></div>
                <table>
                <tbody><tr><th></th>
                 <th>Eventname</th><th>Veranstaltungsort</th>
                </tr>';
      
        foreach ($this->vars['eventlist'] as $event) {
     
            echo '<tr><td><a href="/event/'.$event->getId() . '">Show</a> <input type="checkbox" /> &#8239;
                <img src="/images/icon_write_full.png" height="14" />
                <img src="/images/icon_del_full.png" height="14" /></td>
                    ' ."<td>" . $event->getName() . "</td>"
                     ."<td>" . $event->getLocation() . "</td>";
        }
        echo '</tr></tbody></table>';
    }
    
      public function newform() {
        include 'form.php';
    }

}
