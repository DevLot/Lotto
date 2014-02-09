<?php

class PlayerDetailView extends View {

    public function display() {

        $player = $this->vars['player'];

        echo '<div class="subcontrol"><div class="button"><a href="/player/">Übersicht</a></div>';
        echo '<div class="button"><a href="/player/' . $player->getId() . '/edit">Bearbeiten</a></div>';
        echo '<div class="button"><a href="/player/' . $player->getId() . '/delete">Löschen</a></div>';
        echo "</div><div class=\"list\"><table><tr><td>ID</td><td>" . $player->getId() . "</td></tr>
      <tr><td>Vorname</td><td>" . $player->getFirstname() . "</td></tr>
      <tr><td>Nachname</td><td>" . $player->getSurname() . "</td></tr>
      <tr><td>Geburtstag</td><td>" . $player->getBirthdate() . "</td></tr>
      <tr><td>Adresse</td><td>" . $player->getAddress() . "</td></tr>
      <tr><td>PLZ</td><td>" . $player->getZipcode() . "</td></tr>
      <tr><td>Ort</td><td>" . $player->getCity() . "</td></tr>
      <tr><td>Tel.</td><td>" . $player->getPhone() . "</td></tr>
      <tr><td>Mobile</td><td>" . $player->getMobile() . "</td></tr>
      <tr><td>Mail</td><td>" . $player->getMail() . "</td></tr>
   
      </table></div>";
    }

    public function editform() {
        echo 'geili sach';
    }

    public function deleteform() {
        $player = $this->vars['player'];
        echo 'Möchten Sie den Spieler ' . $player->getFirstname() . ' ' . $player->getSurname() . ' wirklcih löschen?';
    }

}
