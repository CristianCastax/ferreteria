<?php
//CONTROLADOR
// print_r($_GET);
// print_r($_POST);
include('marca.class.php');
$app = new Marca();
include('views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_marca = (isset($_GET['id_marca'])) ? $_GET['id_marca'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_marca);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Marca eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar la marca";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/marca/index.php');
        break;
    case 'create':
        include('views/marca/form.php');
        break;
    case 'save':
        $datos = $_POST;
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La marca se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar la marca";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/marca/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_marca);
        if (isset($datos["id_marca"])) {
            include('views/marca/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe la marca especificada.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/marca/index.php');
        }
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_marca,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La marca se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar la marca";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/marca/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/marca/index.php');
}
include('views/footer.php');
