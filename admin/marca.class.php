<?php
//MODELO 
require_once(__DIR__."/sistema.class.php");
class Marca extends Sistema{
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_marca, marca, fotografia FROM marca;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_marca){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_marca, marca, fotografia FROM marca WHERE id_marca=:id_marca;");
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
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
    function insert($datos){
        $this->connect();
        $nombre_archivo = $this->upload('marcas'); //nombre tendrá dos posibles valores, el nombre del archivo o false
        if($nombre_archivo){
            if ($this->validate_marca($datos)) {
                $stmt=$this->conn->prepare("INSERT INTO marca (marca, fotografia) VALUES (:marca, :fotografia);");
                $stmt->bindParam(':marca', $datos['marca'], PDO::PARAM_STR);
                $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->rowCount();
            }
        }
        return 0;
    }

    function delete($id_marca){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM marca WHERE id_marca=:id_marca;");
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function update($id_marca, $datos){//datos es un array
        $this->connect();
        $stmt=$this->conn->prepare("UPDATE marca SET marca=:marca
        WHERE id_marca=:id_marca;");
        $stmt->bindParam(':marca', $datos['marca'], PDO::PARAM_STR);
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function validate_marca($datos){
        if (empty($datos['marca'])) {
            return false;
        }   
        return true;
    }
}
