<?php

class CardFormView extends View {

    public function display() {

        //Show edit form if card is setted
        if (isset($this->vars['card'])) {
            $card = $this->vars['card'];

            $playerlist = $this->vars['playerlist'];

            echo '<div class="title">Karte bearbeiten</div>
             <form id="form" action="update"  method="post">
            Spielkartenhalter: <select name="player" id="player"><option value="0"></option>';

            //Select dropdown with each player
            foreach ($playerlist as $player) {

                if ($player->getId() == $card->getPlayer()) {
                    echo '<option value="' . $player->getId() . '" selected>' . $player->getFirstname() . ' ' . $player->getSurname() . '</option>';
                } else {
                    echo '<option value="' . $player->getId() . '">' . $player->getFirstname() . ' ' . $player->getSurname() . '</option>';
                }
            };
            echo'</select>
                 
             <input type="hidden" id="id" name="id" value="' . $card->getId() . '">';

            echo '<div class = "card">
                    <table>
                    <tr>
                        <td><input type="text" id="line1" name="line1" value="' . $card->getLine1() . '"></td>

                    </tr>
                    <tr>
                        <td><input type="text" id="line2" name="line2" value="' . $card->getLine2() . '"></td>

                    </tr>
                    <tr>
                        <td><input type="text" id="line3" name="line3" value="' . $card->getLine3() . '"></td>

                    </tr>
                    </table>
                    <input type="hidden" id="cardnr" name="cardnr" value="' . $card->getCardnr() . '">
                   <div class = "number">' . $card->getCardnr() . '</div>
                    </div>

                  <input type="submit" value="Änderungen speichern">   
                    </form>';
        
            
                } else { //Show new form

            echo '<div class="title">Karte erfassen</div>
            
                
        <form id="form" action="new"  method="post">

              <div class = "card">
                <table>
                <tr>
                    <td><input type="text" id="line1" name="line1"></td>

                </tr>
                <tr>
                    <td><input type="text" id="line2" name="line2"></td>

                </tr>
                <tr>
                    <td><input type="text" id="line3" name="line3" ></td>

                </tr>
                </table>

             <div class="number">Cardnumber</div> <input type="text" id="cardnr" name="cardnr">
                </div>

              <input type="submit" value="Karte erstellen">   
                </form>';
        }
    }

}
