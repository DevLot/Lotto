<?php

class LoginView extends View {

    public function display() {
        echo '
            
                    <div class="grid grid_3">
                        <h1>Login</h1>
                                            
                    <div class="inputform">
                    <form action="login/update" Method="post"> 
                            Benutzername<br/>
                            <input type="text" name="username" size="25">
                                <br>Passwort<br />
                            <input type="password" name="password" size="25"><br> <br> 
                            <input type="submit" value="Absenden"> 

                            </form>
</div></div>';
    }

}
