<?php
//CONTROLADOR
include(__DIR__.'/cliente.class.php');
$app = new Cliente();
include(__DIR__.'/views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_cliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_cliente);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Cliente eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar el cliente";
        }
        $datos = $app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/cliente/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/cliente/form.php');
        break;
    case 'save':
        $datos = $_POST;
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El cliente se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar el cliente";
        }
        $datos = $app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/cliente/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_cliente);
        if (isset($datos["id_cliente"])) {
            include(__DIR__.'/views/cliente/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe el cliente especificado.";
            $datos = $app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/cliente/index.php');
        }
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_cliente,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El cliente se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar el cliente";
        }
        $datos = $app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/cliente/index.php');
        break;
    default:
        $datos = $app->getAll();
        include(__DIR__.'/views/cliente/index.php');
}
include(__DIR__.'/views/footer.php');
