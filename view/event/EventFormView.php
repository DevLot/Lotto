<?php

class EventFormView extends View {

    public function display() {

        if (isset($this->vars['event'])) {
            $event = $this->vars['event'];

            echo '<div class="title">Veranstaltung bearbeiten</div><form id="form" action="update"  method="post">
                 
        <input type="hidden" id="id" name="id" value="' . $event->getId() . '">

               <label>Name</label>
          <input type="text" id="name" name="name" value="' . $event->getName() . '">

          <label>Name</label>
          <input type="text" id="location" name="location" value="' . $event->getLocation() . '">

          <label>Veranstalter</label>
          <input type="text" id="organizer" name="organizer" value="' . $event->getOrganizer() . '">

         <label>Datum</label>
          <input type="date" id="date" name="date" value="' . $event->getDate() . '">



              <input type="submit" value="Änderungen speichern">   
              </form>';
        } else {

            echo '<div class="title">Veranstaltung erstellen</div><form id="form" action="create"  method="post">


               <label>Name</label>
          <input type="text" id="name" name="name">

          <label>Ort</label>
          <input type="text" id="location" name="location">

          <label>Veranstalter</label>
          <input type="text" id="organizer" name="organizer">

        <label>Datum</label>
          <input type="date" id="date" name="date">


              <input type="submit" value="Speichern">   
              </form>';
        }
    }

}
