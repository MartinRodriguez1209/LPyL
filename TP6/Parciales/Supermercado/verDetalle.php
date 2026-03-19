<?php
$json = "hola";
include 'producto.php';

if (isset($_POST['nombreProdu'])) {
    $productos = producto::getProductoBD($_POST['nombreProdu']);
    $obj = new stdClass();
    $obj->productos = [];
    for ($i = 0; $i < count($productos); $i++) {
        $producto = new stdClass();
        $producto->precio = $productos[$i]->getPrecio();
        $producto->nombreSuper = $productos[$i]->getNombreSupermercado();
        $producto->ubicacion = $productos[$i]->getUbicacion();
        $obj->productos[] = $producto;
    }
    $json = json_encode($obj);
}
echo $json;
?>