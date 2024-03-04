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

    function upload($carpeta){ //Para validar lo que suban 
        $permitidos = array('image/gif', 'image/png', 'image/jpeg'); //tipos mime permitidos
        //si entra quiere decir que si está en los archivos permitido
        if(in_array($_FILES['fotografia']['type'],$permitidos)){
            //preguntar por el tamaño
            if($_FILES['fotografia']['size']<=500000){
                //preguntar por el nombre para que sean diferentes
                $num_aleatorio = rand(0,1000000);
                $nombre_archivo = $num_aleatorio.$_FILES['fotografia']['size'].$_FILES['fotografia']['name'];
                $nombre_archivo = md5($nombre_archivo); //encriptar el nombre, longitud 32 
                $extension = explode('.',$_FILES['fotografia']['name']); //Genera en $extension un array
                $extension = $extension[sizeof($extension)-1]; //Obtiene la extensión del archivo
                $nombre_archivo = $nombre_archivo.'.'.$extension; //Concatena el nombre del archivo con la extensión
                
                if(!file_exists('../uploads/'.$carpeta.'/'.$nombre_archivo)){
                    move_uploaded_file($_FILES['fotografia']['tmp_name'],'../uploads/'.$carpeta.'/'.$nombre_archivo);
                    return $nombre_archivo;   
                }

            }
        }
        return false;
    }
}
?>