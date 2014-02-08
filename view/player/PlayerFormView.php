<?php

class PlayerFormView extends View {

    public function display() {

        if (isset($this->vars['player'])) {
            $player = $this->vars['player'];
             
             echo '<div class="title">Spieler bearbeiten</div><form id="form" action="update"  method="post">
                 
<input type="hidden" id="id" name="id" value="'.$player->getId().'">

       <label>Vorname</label>
  <input type="text" id="firstname" name="firstname" value="'.$player->getFirstname().'">

  <label>Name</label>
  <input type="text" id="surname" name="surname" value="'.$player->getSurname().'">

  <label>Geb.-Datum</label>
  <input type="date" id="birthdate" name="birthdate" value="'.$player->getBirthdate().'">

  <label>Adresse</label>
  <input type="text" id="address" name="address" value="'.$player->getAddress().'">

  <label>PLZ</label>
  <input type="text" id="zipcode" name="zipcode" value="'.$player->getZipcode().'">

  <label>Ort</label>
  <input type="text" id="city" name="city" value="'.$player->getCity().'">

  <label>Telefon</label>
  <input type="tel" id="phone" name="phone" value="'.$player->getPhone().'">

  <label>Mobiltelefon</label>
  <input type="tel" id="mobile" name="mobile" value="'.$player->getMobile().'">

  <label>Mail</label>
  <input type="mail" id="mail" name="mail" value="'.$player->getMail().'">

      <input type="submit" value="Änderungen speichern">   
      </form>';
        } else {
  
        echo '<div class="title">Spieler erfassen</div><form id="form" action="create"  method="post">

       <label>Vorname</label>
  <input type="text" id="firstname" name="firstname">

  <label>Name</label>
  <input type="text" id="surname" name="surname">

  <label>Geb.-Datum</label>
  <input type="date" id="birthdate" name="birthdate">

  <label>Adresse</label>
  <input type="text" id="address" name="address">

  <label>PLZ</label>
  <input type="text" id="zipcode" name="zipcode">

  <label>Ort</label>
  <input type="text" id="city" name="city">

  <label>Telefon</label>
  <input type="tel" id="phone" name="phone">

  <label>Mobiltelefon</label>
  <input type="tel" id="mobile" name="mobile">

  <label>Mail</label>
  <input type="mail" id="mail" name="mail">

      <input type="submit" value="Speichern & hinzufügen">   
      </form>';
        }


    }
}