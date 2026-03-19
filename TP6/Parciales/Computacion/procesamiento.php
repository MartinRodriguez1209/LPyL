<?php
$json = "hola";
include 'productoComputacion.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $productos = null;
    $obj = new stdClass();
    $obj->productos = [];
    $obj->mensaje = null;
        switch ($action) {

            case 'detalles':
                if (isset($_POST['nombreProdu'])) {
                    if(isset($_POST['codigo']) && isset($_POST['sucursal']) && isset($_POST['cantidad']))
                    {
                        $mensaje = ProductoComputacion::actualizaStock($_POST['cantidad'],$_POST['codigo'],$_POST['sucursal']);
                        $obj->mensaje = $mensaje;
                    }
                    $productos = ProductoComputacion::getProductosDetalleBD($_POST['nombreProdu']);
                    for($i=0;$i<count($productos);$i++)
                    {
                        $producto = new stdClass();
                        $producto->nombreProducto = $productos[$i]->getNombreProducto();
                        $producto->codigo = $productos[$i]->getCodigo();
                        $producto->sucursal = $productos[$i]->getSucursal();
                        $producto->cantidad = $productos[$i]->getCantidad();
                        $producto->fecha = $productos[$i]->getFechaAlta();
                        $producto->proveedor = $productos[$i]->getProveedor();
                        $obj->productos[] = $producto;
                    }
                }
                break;
            case 'filtra':
                if (isset($_POST['idInput'])) {
                    $productos = ProductoComputacion::getProductosBD($_POST['idInput'],'si');
                    for($i=0;$i<count($productos);$i++)
                    {
                        $producto = new stdClass();
                        $producto->nombreProducto = $productos[$i]->getNombreProducto();
                        $obj->productos[] = $producto;
                    }
                }
                break;
            default:
                break;
    }
    $json = json_encode($obj);
}
echo $json;
?>