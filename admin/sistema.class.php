<?php
class Sistema{
    var $conn;
    var $count=0;
    function connect(){
        $servername = "localhost";
        $username = "ferreteria";
        $password = "123";
        $dbname = "ferreteria";

        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }
    function setCount($count){
        $this->count = $count;
    }
    function getCount(){
        return $this->count;
    }
}
?>