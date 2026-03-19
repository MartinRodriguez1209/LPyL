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
            <div>
                <?php
                include 'productoSM.php';
                $nombres = ProductoSM::getNombresProduBD();
                $ubicaciones = ProductoSM::getUbicacionesBD();
                ?>
                <select id="idFiltrosProductos" onChange="filtraProductos();">
                    <option value="" >--Selecciona un producto--</option>
                    <?php
                    for($i=0 ; $i<count($nombres) ; $i++)
                    {
                        echo "<option value='{$nombres[$i]->nombre}'>{$nombres[$i]->nombre}</option>";
                    }
                    ?>
                </select>
                <select id="idFiltrosUbicacion" onChange="filtraProductos();">
                    <option value="" >--Selecciona una ubicacion--</option>
                    <?php
                    for($i=0 ; $i<count($ubicaciones) ; $i++)
                    {
                        echo "<option value='{$ubicaciones[$i]->ubicacion}'>{$ubicaciones[$i]->ubicacion}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="tabla-scroll-contenedor">
                <table>
                    <caption>Productos</caption>
                    <thead>
                        <tr>
                            <td>Producto</td>
                            <td>Precio</td>
                            <td>Supermercado</td>
                            <td>Ubicacion</td>
                        </tr>
                    </thead>
                    <tbody id="contenedor-productos">
                        <?php
                        
                        $productos = ProductoSM::getProductosBD(null,null,'ninguno');
                        for($i=0 ; $i<count($productos) ; $i++)
                        {
                            echo "<tr onClick=\"detalleProducto('{$productos[$i]->nombreProdu}');\">";
                            echo "<td>{$productos[$i]->nombreProdu}</td>";
                            echo "<td>{$productos[$i]->precio}</td>";
                            echo "<td>{$productos[$i]->nombreSuper}</td>";
                            echo "<td>{$productos[$i]->ubicacion}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="div-info" class="tabla-scroll-contenedor oculto">
                <table>
                    <caption id="caption-producto"></caption>
                    <thead>
                        <tr>
                            <td>Sucursal</td>
                            <td>Precio</td>
                            <td>Ubicacion</td>
                        </tr>
                    </thead>
                    <tbody id="tabla-producto"></tbody>
                    <tfooter>
                        <tr>
                            <td id="informacion" colspan="3"></td>
                        </tr>
                    </tfooter>
                </table>
            </div>
        </article>
    </section>
    
<footer>Titos Felix Aldo</footer>
<script src="script.js"></script>
</body>
</html>