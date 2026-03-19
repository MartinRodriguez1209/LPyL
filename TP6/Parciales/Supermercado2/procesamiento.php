<?php
$json = "hola";
include 'productoSM.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $productos = null;
    switch ($action)
    {
        case 'ambos':
            $productos = ProductoSM::getProductosBD($_POST['producto'],$_POST['ubicacion'],'ambos');
            break;
        case 'producto':
            $productos = ProductoSM::getProductosBD($_POST['producto'],null,'nombre');
            break;
        case 'ubicacion':
            $productos = ProductoSM::getProductosBD(null,$_POST['ubicacion'],'ubicacion');
            break;
        case 'ninguno':
            $productos = ProductoSM::getProductosBD(null,null,'ninguno');
            break;
        default:
            break;
    }
    $obj = new stdClass();
    $obj->productos = $productos;
    $json = json_encode($obj);
}
echo $json;
?>