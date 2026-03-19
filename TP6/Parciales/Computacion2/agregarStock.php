<?php
$json = "hola";
include 'productoComp.php';

if (isset($_POST['codigo']) && isset($_POST['sucursal']) && isset($_POST['cantidad'])) {
    $codigo = $_POST['codigo'];
    $cantidad = $_POST['cantidad'];
    $sucursal = $_POST['sucursal'];
    $obj = new stdClass();
    ProductoComp::actualizaStock($cantidad,$codigo,$sucursal);
    $obj->productos = ProductoComp::getDetallesProduBD($_POST['nombreProdu']);
    $json = json_encode($obj);
}
echo $json;
?>