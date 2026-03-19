<?php
$json = "hola";
include 'productoSM.php';

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $producto = ProductoSM::getProductoInfoBD($nombre);
    $obj = new stdClass();
    $obj->producto = $producto;
    $json = json_encode($obj);
}
echo $json;
?>