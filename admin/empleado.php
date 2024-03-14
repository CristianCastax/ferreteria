<?php
//CONTROLADOR
include(__DIR__.'/empleado.class.php');
$app = new Empleado();
include(__DIR__.'/views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_empleado = (isset($_GET['id_empleado'])) ? $_GET['id_empleado'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_empleado);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Empleado eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar el empleado";
        }
        $datos = $app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/empleado/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/empleado/form.php');
        break;
    case 'save':
        $datos = $_POST;
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El empleado se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar el empleado";
        }
        $datos = $app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/empleado/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_empleado);
        if (isset($datos["id_empleado"])) {
            include(__DIR__.'/views/empleado/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe el empleado especificado.";
            $datos = $app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/empleado/index.php');
        }
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_empleado,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El empleado se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar el empleado";
        }
        $datos = $app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/empleado/index.php');
        break;
    default:
        $datos = $app->getAll();
        include(__DIR__.'/views/empleado/index.php');
}
include(__DIR__.'/views/footer.php');
