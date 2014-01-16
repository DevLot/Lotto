<?php

class CardDetailView extends View {

    public function display() {
      $card = $this->vars['card'];
      echo $card->getName();
      echo "ID des Objeks:";
      echo $card->getId();
      
    }

}

