<?php

final class MysqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;
    private $sql;

    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        $this->open();
    }

    public function __destruct() {
        $this->close();
    }

    private function open() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_errno) {
            echo 'DB Error: ' . $this->con->connect_error;
            $this->con = null;
        } else {
            $this->con->set_charset('utf8');
        }
    }

    private function close() {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }

    public function getCard() {
        
        $res = $this->con->query("SELECT * FROM fabingo.cards WHERE id=2;");
        //$res->free();
        $row = $res->fetch_object()->line1;        
        
        return $row;
    }
    public function setCard() {
        $sql = 
        $this->con->query("INSERT INTO cards(cardnr, line1, line2, line3, player, create_on, update_on) VALUES(9999,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8','Max Muster', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());");           
    }
    public function getPlayers() {
        
    }
    public function createPlayer($fn,$sn,$bd,$ad,$zc,$ci,$ph,$mo,$ma) {
        
        $firstname = $fn;
        $surname = $sn;
        $birthdate = $bd;
        $address = $ad;
        $zipcode = $zc;
        $city = $ci;
        $phone = $ph;
        $mobile = $mo;
        $mail = $ma;
        
        $sql = "INSERT INTO players
                (
                    firstname,surname,birthdate,address,zipcode,city,phone,mobile,mail,create_on,update_on
                )
                VALUES
                (
                    '$firstname','$surname','$birthdate','$address','$zipcode','$city','$phone','$mobile','$mail',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()
                    
                );
         ";
        
        $this->con->query($sql);
        //'.$firstname.','.$surname.','$birthdate.','.$address.','.$zipcode.','.$city.','.$phone.','.$mobile.','.$mail.',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP()
    }

}