<?php
//ARCHIVO DE CONFIGURACION- Mando todas las variables a este archivo de configuracion
define('DB_DRIVER', 'mysql'); //Define el driver de la base de datos
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'ferreteria');
define('DB_USER', 'ferreteria');
define('DB_PASSWORD', '123');
class config{
    //var $image = array();	
    function getImageSize(){
        return 512000;
    }
    function getImageType(){
        return array('image/jpeg', 'image/png', 'image/gif');
    }
}
?>