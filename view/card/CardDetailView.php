<?php

class CardDetailView extends View {

    public function display() {
      
        $card = $this->vars['card'];
      echo "Editieren funzt<br /> Kartennr:";
      echo $card->getCardNr();
      echo "ID des Objeks:";
      echo $card->getId();
      
    }

}

