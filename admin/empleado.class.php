<?php
//MODELO 
require_once(__DIR__."/sistema.class.php");
class Empleado extends Sistema{
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_empleado, primer_apellido, segundo_apellido, nombre, rfc, curp FROM empleado");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_empleado){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_empleado, primer_apellido, segundo_apellido, nombre, rfc, curp FROM empleado WHERE id_empleado=:id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
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
        if ($this->validate_empleado($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO empleado (primer_apellido, segundo_apellido, nombre, rfc, curp)
                                        VALUES (:primer_apellido, :segundo_apellido, :nombre, :rfc, :curp);");
            $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
            $stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }
/*
    function Insert($datos){
        $this->connect();
        // Primero, verifica si se ha enviado una imagen
        $imagenCodificada = file_get_contents("php://input"); //Obtener la imagen

            if(strlen($imagenCodificada) <= 0) {
                $imagenCodificadaLimpia = null; // Si no se envió una imagen, se guarda como null en la base de datos
            }
            if(strlen($imagenCodificada) > 0) { //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
                //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
                //todo el contenido lo guardamos en un archivo
                $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
                $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
            }
    
        if ($this->validate_empleado($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO empleado (primer_apellido, segundo_apellido, nombre, rfc, curp, fotografia)
                                        VALUES (:primer_apellido, :segundo_apellido, :nombre, :rfc, :curp, :fotografia);");
            $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
            $stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
            $stmt->bindParam(':fotografia', $imagenCodificadaLimpia);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }
    */
    

    function Update($id_empleado,$datos){//datos es un array
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE empleado SET 
            id_empleado=:id_empleado,
            primer_apellido=:primer_apellido,
            segundo_apellido=:segundo_apellido,
            nombre=:nombre,
            rfc=:rfc,
            curp=:curp
            WHERE id_empleado=:id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
        $stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function delete($id_empleado){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM empleado WHERE id_empleado=:id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function validarRFC($rfc){
        $regex = '/^[A-Z]{4}[0-9]{6}[A-Z0-9]{3}$/'; //para una expresion regular se inicia con /^ y se termina con /$
        return preg_match($regex, $rfc);
    }
    function validarCURP($curp){
        $regex = '/^[A-Z]{4}[0-9]{6}[H|M]{1}[A-Z0-9]{7}$/'; //para una expresion regular se inicia con /^ y se termina con /$
        return preg_match($regex, $curp);
    }

    function validate_empleado($datos){
        if (empty($datos['nombre'])) {
            return false;
        }   
        if (empty($datos['rfc'])) {
            return false;
        }
        if (empty($datos['curp'])) {
            return false;
        }
        if (!$this->validarRFC($datos['rfc'])) { //
            return false;
        }
        if (!$this->validarCURP($datos['curp'])) { //
            return false;
        }
        return true;
    }

    
}
