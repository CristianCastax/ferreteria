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
    function setCount($count){ $this->count = $count; }
    function getCount(){ return $this->count; }

    function upload(){ //Para validar lo que suban 
        $permitidos = array('image/gif', 'image/png', 'image/jpeg'); //tipos mime permitidos
        //si entra quiere decir que si está en los archivos permitido
        if(in_array($_FILES['fotografia']['type'],$permitidos)){
            //preguntar por el tamaño
            if($_FILES['fotografia']['size']<=500000){
                move_uploaded_file($_FILES['fotografia']['tmp_name'],'../uploads/productos/'.$_FILES['fotografia']['name']);
                return $_FILES['fotografia']['name'];
            }
        }
        return false;
    }
}
?>