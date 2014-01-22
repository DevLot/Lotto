<?php

class EventView extends View {

    public function display() {
        echo '<div class="subcontrol"><div class="button"><a href="/event/new">Neuer Event</a></div>
            </div><div class="list">
                <table>
                <tbody><thead><th></th>
                 <th>Eventname</th><th>Veranstaltungsort</th>
                </thead><tbody>';
      
        foreach ($this->vars['eventlist'] as $event) {
     
            echo '<tr><td><a href="/event/'.$event->getId() . '">Show</a> <input type="checkbox" /> &#8239;
                <img src="/images/icon_write_full.png" height="14" />
                <img src="/images/icon_del_full.png" height="14" /></td>
                    ' ."<td>" . $event->getName() . "</td>"
                     ."<td>" . $event->getLocation() . "</td>";
        }
        echo '</tr></tbody></table></div>';
    }
    
      public function newform() {
        include 'form.php';
    }

}
