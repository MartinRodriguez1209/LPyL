<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <section>
        <article>
            <div class="tabla-scroll-contenedor">
                <table>
                    <caption>Productos</caption>
                    <tbody id="tabla-productos">
                        <?php
                        include 'productoComp.php';
                        $productos = ProductoComp::getProductosBD(null);
                        for($i=0;$i<count($productos);$i++)
                        {
                            echo "<tr>";
                            echo "<td onClick=\"muestraDetalles('{$productos[$i]->nombreProducto}')\">{$productos[$i]->nombreProducto}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="contenedor-detalle" class="tabla-scroll-contenedor oculto">
                <table>
                    <caption id="producto-nombre"></caption>
                    <thead><tr><td>Sucursal</td><td>Stock Actual</td><td>Cantidad a agregar</td><td></td></tr></thead>
                    <tbody id="tabla-producto-detalle">
                    </tbody>
                </table>
            </div>
        </article>
    </section>
<script src="script.js"></script>
</body>
</html>