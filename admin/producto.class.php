<?php
//MODELO 
require_once("sistema.class.php");
class Producto extends Sistema{
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT p.id_producto, p.producto, p.precio, m.marca
                FROM producto p join marca m on p.id_marca = m.id_marca;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_producto){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT p.id_producto, p.producto, p.precio, m.marca
                FROM producto p join marca m on p.id_marca = m.id_marca
                WHERE id_producto=:id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
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
        if ($this->validate_producto($datos)) {
            // Buscar id_marca basado en el nombre de la marca
            $stmt = $this->conn->prepare("SELECT id_marca FROM marca WHERE LOWER(marca) = LOWER(:marca)");
            $stmt->bindParam(':marca', $datos['marca'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $id_marca = $result['id_marca'];
                $stmt = $this->conn->prepare("INSERT INTO producto 
                                              (producto, precio, id_marca)
                                              VALUES (:producto, :precio, :id_marca);");
                $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->rowCount();
            } else {
                return 0;
            }
        }
        return 0;
    }
    
    function Update($id_producto,$datos){//datos es un array
        $this->connect();
        if ($this->validate_producto($datos)) {
            // Buscar id_marca basado en el nombre de la marca
            $stmt = $this->conn->prepare("SELECT id_marca FROM marca WHERE LOWER(marca) = LOWER(:marca)");
            $stmt->bindParam(':marca', $datos['marca'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $id_marca = $result['id_marca'];
                $stmt = $this->conn->prepare("UPDATE producto SET 
                                              producto=:producto,
                                              precio=:precio,
                                              id_marca=:id_marca
                                              WHERE id_producto=:id_producto;");
                $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
                $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->rowCount();
            } else {
                return 0;// La marca no existe
            }
            return $stmt->rowCount();
        }
    }

    function delete($id_producto){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM producto WHERE id_producto=:id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function validate_producto($datos){
        if (empty($datos['producto'])) {
            return false;
        }   
        return true;
    }
}
