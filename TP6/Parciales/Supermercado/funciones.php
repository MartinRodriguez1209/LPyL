<?php
function cargaPagina()
{
    include 'producto.php';
    $productos = producto::getProductosFiltradosBD(null,null,'Ninguno');
    $nombres = producto::getNombresProductoBD();
    $ubicaciones = producto::getUbicacionesBD();
    
    ?>
    <div>
        <div class="select-div">
            <label for="inputProductos">Ingresa el nombre del producto: </label>
            <input type="text" id="inputProductos" onKeyUp="filtraProductos();" value="">
            <select id="idFiltrosProductos" onChange="filtraProductos();">
                <option value="" >--Selecciona un producto--</option>
                <?php
                    for($i=0;$i<count($nombres);$i++){

                        echo "<option value='".$nombres[$i]."'>".$nombres[$i]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="select-div">
            <select id="idFiltrosUbicacion" onChange="filtraProductos();">
                <option value="" >--Selecciona una ubicacion--</option>
                <?php
                    for($i=0;$i<count($ubicaciones);$i++){
                        echo "<option value='".$ubicaciones[$i]."'>$ubicaciones[$i]</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <br>
    <div id="contenedor-empresas" class="tabla-scroll-contenedor">
        <table class="tabla-moderna">
            <thead><tr>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Supermercado</td>
                <td>Ubicacion</td>
                <td></td>
            </tr></thead>
            <tbody id="tabla-productos">
            <?php
            
            for($i=0;$i<count($productos);$i++)
            {
                $producto = $productos[$i];
                echo "<tr>";
                echo "<td>".$producto->getNombreProducto()."</td>";
                echo "<td>".$producto->getPrecio()."</td>";
                echo "<td>".$producto->getNombreSupermercado()."</td>";
                echo "<td>".$producto->getUbicacion()."</td>";
                echo "<td><input type='button' value='Ver Detalle' onClick=\"verDetalle('" .$producto->getNombreProducto(). "');\" ></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div id="infoProducto" class="oculto tabla-scroll-contenedor">
        <table class="tabla-moderna">
            <caption id="contenedor-nombre"></caption>
            <thead>
                
                <tr>
                    <td>Supermercado</td>
                    <td>Precio</td>
                    <td>Ubicacion</td>
                </tr>
            </thead>
            <tbody id="info-disponibilidad"></tbody>
            <tfooter>
                <td id="resumen"></td>
            </tfooter>
        </table>

    </div>
    <?php
}

?>