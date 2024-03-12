<?php
//MODELO 
require_once(__DIR__."/sistema.class.php");
class Tienda extends Sistema{
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_tienda, tienda, fotografia, latitud, longitud FROM tienda");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_tienda){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_tienda, tienda, fotografia, latitud, longitud
                FROM tienda WHERE id_tienda=:id_tienda;");
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = array();
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return array();
    }
    function Insert($datos){
        $this->connect();
        $nombre_archivo = $this->upload('tiendas'); //nombre tendrá dos posibles valores, el nombre del archivo o false
        if ($nombre_archivo){
            if ($this->validate_tienda($datos)) {
                $stmt = $this->conn->prepare("INSERT INTO tienda (id_tienda, tienda, fotografia, latitud, longitud)
                                                VALUES (:id_tienda, :tienda, :fotografia, :latitud, :longitud);");
                $stmt->bindParam(':id_tienda', $datos['id_tienda'], PDO::PARAM_INT);
                $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
                $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
                $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->rowCount();
            }
        }
        else{
            $stmt = $this->conn->prepare("INSERT INTO tienda (id_tienda, tienda, latitud, longitud)
                                            VALUES (:id_tienda, :tienda, :latitud, :longitud);;");
            $stmt->bindParam(':id_tienda', $datos['id_tienda'], PDO::PARAM_INT);
            $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
            $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
            $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();    
        }
        return 0;
    }

    function Update($id_tienda,$datos){//datos es un array
        $this->connect();
        $nombre_archivo = $this->upload('tiendas');
        if($nombre_archivo){
            $stmt = $this->conn->prepare("UPDATE tienda SET 
            id_tienda=:id_tienda,
            tienda=:tienda,
            fotografia=:fotografia,
            latitud=:latitud,
            longitud=:longitud
            WHERE id_tienda=:id_tienda;");
            $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
        }
        else{
            $stmt = $this->conn->prepare("UPDATE tienda SET 
            id_tienda=:id_tienda,
            tienda=:tienda,
            latitud=:latitud,
            longitud=:longitud
            WHERE id_tienda=:id_tienda;");
        }
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
        $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
        $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function delete($id_tienda){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM tienda WHERE id_tienda=:id_tienda;");
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function validate_tienda($datos){
        if (empty($datos['tienda'])) {
            return false;
        }   
        return true;
    }
}
