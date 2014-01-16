<?php

class PlayerDetailView extends View {

    public function display() {
      
      $player = $this->vars['player'];
      echo "Player:";
      echo $player->getFirstname();
      echo "ID des Objeks:";
      echo $player->getId();
      
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
    
     
   public function editform() {
        echo 'geili sach';
    }
    
    public function deleteform() {
        $player = $this->vars['player'];
                echo 'Möchten Sie den Spieler '. $player->getFirstname() .' '. $player->getSurname() .' wirklcih löschen?';
                
    }

}

