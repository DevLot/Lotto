<?php

class EventDetailView extends View {

    public function display() {
      
       $event = $this->vars['event'];
               
     echo '<div class="subcontrol"><div class="button"><a href="/event/">Übersicht</a></div>';
     echo '<div class="button"><a href="/event/'.$event->getId().'/edit">Bearbeiten</a></div>';
     echo '<div class="button"><a href="/event/'.$event->getId().'/delete">Löschen</a></div>';
      echo  "</div><div class=\"list\"><table><tr><td>ID</td><td>" . $event->getId() . "</td></tr>
      <tr><td>Name des Event</td><td>" . $event->getName() . "</td></tr>
      <tr><td>Veranstalter</td><td>" . $event->getOrganizer() . "</td></tr>
      <tr><td>Ort</td><td>" . $event->getLocation() . "</td></tr>
      <tr><td>Datum</td><td>" . $event->getDate() . "</td></tr>
      <tr><td>Erstellungsdatum</td><td>" . $event->getCreateOn() . "</td></tr>
   
      </table></div>";
     
    }
    
      
      
    }


