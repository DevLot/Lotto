<?php

class CardFormView extends View {

    public function display() {
        
         echo '<div class="subcontrol"><div class="button"><a href="/card/">Übersicht</a></div></div>';

        if (isset($this->vars['card'])) {
            $card = $this->vars['card'];
             
             echo '<form id="form" action="update"  method="post">
                 
             <input type="hidden" id="id" name="id" value="'.$card->getId().'">';

     
        echo '<div class = "card">
        <table>
        <tr>
            <td><input type="text" id="line1" name="line1" value="'.$card->getLine1().'"></td>
           <td></td>
           <td></td>
           <td></td
           ><td></td>
        </tr>
        <tr>
            <td><input type="text" id="line1" name="line1" value="' .$card->getLine2(). '"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><input type="text" id="line1" name="line1" value="' .$card->getLine3(). '"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </table>
        
       <div class = "number">'. $card->getCardnr() .'</div>
        </div>

      <input type="submit" value="Änderungen speichern">   
        </form>'; } else {
            
            echo '<form id="form" action="new"  method="post">
        
      <div class = "card">
        <table>
        <tr>
            <td><input type="text" id="line1" name="line1></td>
           <td></td>
           <td></td>
           <td></td
           ><td></td>
        </tr>
        <tr>
            <td><input type="text" id="line1" name="line1"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><input type="text" id="line1" name="line1" ></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </table>
        
     <div class="number">Cardnumber</div> <input type="text" id="cardnr" name="cardnr" >
        </div>

      <input type="submit" value="Karte erstellen">   
        </form>';
            
        }
      
} }