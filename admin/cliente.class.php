<?php
//MODELO 
require_once(__DIR__."/sistema.class.php");
class Cliente extends Sistema{
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_cliente, primer_apellido, segundo_apellido, nombre, rfc FROM cliente");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }
    function getOne($id_cliente){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_cliente, primer_apellido, segundo_apellido, nombre, rfc FROM cliente WHERE id_cliente=:id_cliente;");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
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
        if ($this->validate_cliente($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO cliente (primer_apellido, segundo_apellido, nombre, rfc)
                                        VALUES (:primer_apellido, :segundo_apellido, :nombre, :rfc);");
            $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }
    function Update($id_cliente,$datos){//datos es un array
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE cliente SET 
            id_cliente=:id_cliente,
            primer_apellido=:primer_apellido,
            segundo_apellido=:segundo_apellido,
            nombre=:nombre,
            rfc=:rfc   
            WHERE id_cliente=:id_cliente;");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function delete($id_cliente){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM cliente WHERE id_cliente=:id_cliente;");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function validate_cliente($datos){
        if (empty($datos['nombre'])) {
            return false;
        }   
        return true;
    }
}