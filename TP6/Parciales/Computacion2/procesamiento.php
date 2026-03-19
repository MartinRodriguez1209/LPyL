<?php
$json = "hola";
include 'productoComp.php';

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $obj = new stdClass();
    $obj->productos = ProductoComp::getDetallesProduBD($codigo);
    $json = json_encode($obj);
}
echo $json;
?>