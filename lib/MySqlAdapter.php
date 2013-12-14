<?php

final class MysqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;

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

//    public function getCard() {
//
//        $res = $this->con->query("SELECT line1 FROM fabingo.cards WHERE id=2;");
//        $list = $res;
//        $res->free();
//        return $list;
//    }

    public function getPlayers() {
        $playerlist = array();
        $res = $this->con->query("SELECT * FROM fabingo.player ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $player = new Player($row['firstname'], $row['surname'], 
                    $row['birthdate'], $row['address'], $row['zipcode'],
                    $row['city'], $row['phone'], $row['mobile'], $row['mail']);
            $playerlist[] = $player;
        }
        $res->free();
        return $playerlist;
           
}
}

