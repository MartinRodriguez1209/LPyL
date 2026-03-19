<?php
$json = "hola";
include 'producto.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $productos = null;
        switch ($action) {

            case 'Ambos':
                if (isset($_POST['nombreProdu']) && isset($_POST['ubicacion'])) {
                    $productos = producto::getProductosFiltradosBD($_POST['nombreProdu'],$_POST['ubicacion'],'Ambas');
                }
                break;

            case 'Nombre':
                if (isset($_POST['nombreProdu'])) {
                    $productos = producto::getProductosFiltradosBD($_POST['nombreProdu'],null,'Producto');
                }
                break;

            case 'Ubicacion':
                if (isset($_POST['ubicacion'])) {
                    $productos = producto::getProductosFiltradosBD(null,$_POST['ubicacion'],'Ubicacion');
                }
                break;

            case 'Todo':
                if (isset($_POST['idNinguno'])) {
                    $productos = producto::getProductosFiltradosBD(null,null,'Ninguno');
                }
                break;
            default:
                break;
    }

    $obj = new stdClass();
    $obj->productos = [];
    for ($i = 0; $i < count($productos); $i++) {
        $producto = new stdClass();
        $producto->id_producto = $productos[$i]->getIdproducto();
        $producto->nombreProducto = $productos[$i]->getNombreProducto();
        $producto->precio = $productos[$i]->getPrecio();
        $producto->id_super = $productos[$i]->getIdSupermercado();
        $producto->nombreSuper = $productos[$i]->getNombreSupermercado();
        $producto->ubicacion = $productos[$i]->getUbicacion();
        $obj->productos[] = $producto;
    }
    $json = json_encode($obj);
}
echo $json;
?>