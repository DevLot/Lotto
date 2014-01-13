<?php

class EventDetailView extends View {

    public function display() {
      
      $event = $this->vars['event'];
      echo $event->getName();
      echo "ID des event:";
      echo $event->getId();
      
    }

}

