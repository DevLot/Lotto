<?php

class HomeView extends View {

    public function display() {
        echo '<div class="grid grid_1">
                        <h1>Event</h1>
                        
                        <ul>
                            
                            <li><a href="/game/">Spiel starten</a></li>
                            <li><a href="/event/">Spieler hinzufügen</a></li>
                            
                        </ul>
                       
                    </div>

                    <div class="grid grid_1">
                        <h1>Eventmanagement</h1>
                        
                        
                        <ul class="nav">
                            
                            <li><a href="/event">Veranstaltungen anzeigen</a></li>
                            <li><a href="/event/new">Veranstaltung hinzufügen</a></li>
                            <li><a href="/event">Veranstaltung bearbeiten</a></li>
                         </ul>
                    </div>

                    <div class="grid grid_1">
                        <h1>Verwaltung</h1>
                        
                        <ul>
                            <li><a href="/player">Spieler</a></li>
                            <li><a href="/card">Spielkarten</a></li>
                            <li><a href="/account">Eigene Einstellungen</a></li>
                        </ul>
                            
                    </div>';
    }

}

