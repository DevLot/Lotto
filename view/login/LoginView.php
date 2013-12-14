<?php

class LoginView extends View {

    public function display() {
        echo "Das wäre der Login";
        
        
        echo '<a href="/home">home</a><br />';
            echo '<a href="/event">event</a><br />';
        echo '<a href="/player">player</a><br />';
            echo '<a href="/account">account</a><br />';
    }

}

