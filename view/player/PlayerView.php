<?php

class PlayerView extends View {

    public function display() {

        //Button and th of table
        include 'table_top.php';

        foreach ($this->vars['playerlist'] as $player) {

            echo '<tr class="clickableRow" href="/player/'. $player->getId() . '"><td>
                <a href="/player/'. $player->getId() .'/edit"><img src="/images/icon_write_full.png" height="14" /></a>
               <a href="/player/'. $player->getId() .'/delete"> <img src="/images/icon_del_full.png" height="14" /></a></td>' .
            "<td>" . $player->getFirstname() . "</td>" .
            "<td>" . $player->getSurname() . "</td>" .
            "<td>" . $player->getBirthdate() . "</td>" .
            "<td>" . $player->getAddress() . "</td>" .
            "<td>" . $player->getZipcode() . "</td>" .
            "<td>" . $player->getCity() . "</td></tr>" ;
        }
        echo '</tr></tbody></table></div>';
        
        echo  '<script type="text/javascript">
            jQuery(document).ready(function($) {
      $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
});</script>';
        
        
        
    }
    

}
