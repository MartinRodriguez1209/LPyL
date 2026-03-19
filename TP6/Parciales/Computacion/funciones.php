<?php
function cargaPagina()
{
    include 'productoComputacion.php';
    $productos = ProductoComputacion::getProductosBD(null,null);
    ?>
    <div>
        <label for="inputProductos">Ingresa el nombre del producto: </label>
            <input type="text" id="inputProductos" onKeyUp="filtraProductos();" value="">
    </div>
    <div id="contenedor-productos" class="tabla-scroll-contenedor">
        <table class="tabla-moderna">
            <caption>Productos</caption>
            <tbody id="tabla-productos">
                <?php
                for ($i = 0; $i < count($productos); $i++) {
                    $producto = $productos[$i];
                    echo "<tr>";
                    echo "<td onClick=\"verDetalle('".$producto->getNombreProducto()."')\">" . $producto->getNombreProducto() . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="detalles" class="tabla-scroll-contenedor oculto">
        <div id="detalle-producto"></div>
        <table class="tabla-moderna">
        <thead>
            <tr>
                <td>Sucursal</td>
                <td>Cantidad</td>
                <td>Fecha Alta</td>
                <td>Stock a agregar</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="tabla-sucursales"></tbody>
        <div id="mensaje"></div>
        </table>
    </div>

    <?php
}
?>