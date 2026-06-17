<?php
require_once 'Productos.php';



function conectar()
{
    $conexion = new mysqli("localhost", "root", "", "computacion");
    if ($conexion->connect_error) {

        exit;
    }
    return $conexion;
}



function obtenerTodosProductos()
{
    $conexion = conectar();
    $stmt = $conexion->prepare("SELECT producto.codigo,nombreProducto, precio, proveedor, sucursal, cantidad 
    FROM `producto` INNER JOIN stockproducto on producto.codigo = stockproducto.codigo;");
    $stmt->execute();
    $resultado = $stmt->get_result();
    $temp = [];
    foreach ($resultado as $fila) {
        $codigo = $fila["codigo"];
        if (!isset($temp[$codigo])) {
            $temp[$codigo] = [
                "nombreProducto" => $fila["nombreProducto"],
                "precio"         => $fila["precio"],
                "proveedor"      => $fila["proveedor"],
                "stockSucursal"  => [],
                "codigo" => $fila["codigo"]
            ];
        }
        $temp[$codigo]["stockSucursal"][$fila["sucursal"]] = $fila["cantidad"];
    }

    $productos = [];
    foreach ($temp as $datos) {
        $productos[] = new Producto(
            $datos["nombreProducto"],
            array_sum($datos["stockSucursal"]),
            $datos["precio"],
            $datos["proveedor"],
            $datos["stockSucursal"],
            $datos["codigo"]
        );
    }
    echo json_encode($productos);
}

if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    if ($accion == "obtenerProductos") {
        obtenerTodosProductos();
    }
};
