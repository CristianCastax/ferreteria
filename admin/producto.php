<?php
//CONTROLADOR
include('producto.class.php');
$app = new Producto();
include('views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_producto = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_producto);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="producto eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar la producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/producto/index.php');
        break;
    case 'create':
        include('views/producto/form.php');
        break;
    case 'save':
        $datos = $_POST;
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El producto se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/producto/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_producto);
        if (isset($datos["id_producto"])) {
            include('views/producto/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe el producto especificado.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/producto/index.php');
        }
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_producto,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El producto se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/producto/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/producto/index.php');
}
include('views/footer.php');
