<?php

class CardDetailView extends View {

    public function display() {
        $card = $this->vars['card'];
        
        echo "ok";

//        echo "<div class=\"event-info\">\n";
//        echo "<h1>{$card->getName()}</h1>\n";
//        echo "<h2>" . date("d.m.Y H:i", $event->getStarttime()) . "</h2>\n";
//        $artist = $event->getArtist();
//        if ($artist instanceof Artist) {
//            echo "<p><img src=\"/resources/{$artist->getImage()}\" alt=\"{$artist->getName()}\" /></p>\n";
//            echo "<p>{$artist->getDescription()}</p>\n";
//
//            if ($card->getId() == 1) {
//                echo "ok";
//            }
//        }
        echo "</div>\n";
    }

}

