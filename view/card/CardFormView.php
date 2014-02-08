<?php

class CardFormView extends View {

    public function display() {
        

        if (isset($this->vars['card'])) {
            $card = $this->vars['card'];
             
             echo '<div class="title">Karte bearbeiten</div>
             
                  
             <form id="form" action="update"  method="post">
                 
             <input type="hidden" id="id" name="id" value="'.$card->getId().'">';

     
        echo '<div class = "card">
        <table>
        <tr>
            <td><input type="text" id="line1" name="line1" value="'.$card->getLine1().'"></td>
     
        </tr>
        <tr>
            <td><input type="text" id="line2" name="line2" value="' .$card->getLine2(). '"></td>
    
        </tr>
        <tr>
            <td><input type="text" id="line3" name="line3" value="' .$card->getLine3(). '"></td>
         
        </tr>
        </table>
        <input type="hidden" id="cardnr" name="cardnr" value="' .$card->getCardnr(). '">
       <div class = "number">'. $card->getCardnr() .'</div>
        </div>

      <input type="submit" value="Änderungen speichern">   
        </form>'; } else {
            
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
      
} }