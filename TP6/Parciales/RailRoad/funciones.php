<?php
function cargaPagina()
{
    include 'empresa.php';
    include 'servicios.php';
    $ciudades = Servicios::getCiudadesBD();
    $empresas = Empresa::getEmpresasBD();
    
    ?>
    <div>
        <div class="select-div">
            <select id="idFiltrosOrigen" onChange="filtraEmpresas();">
                <option value="" >--Selecciona ciudad de origen--</option>
                <?php
                
                    $origen = $ciudades['ciudadOrigenServicio'];
                    echo "console.log(".$origen.")";
                    for($i=0;$i<count($origen);$i++){
                        echo "<option value='".$origen[$i]."'>$origen[$i]</option>";
                    }
                ?>
            </select>
        </div>
        <div class="select-div">
            <select id="idFiltrosDestino" onChange="filtraEmpresas();">
                <option value="" >--Selecciona ciudad de destino--</option>
                <?php
                    $destino = $ciudades['ciudadDestinoServicio'];
                    for($i=0;$i<count($destino);$i++){
                        echo "<option value='".$destino[$i]."'>$destino[$i]</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <br>
    <div id="contenedor-empresas">
        <ol id="listaEmpresas" class="lista-empresas">
            <?php
            $empresas = Empresa::getEmpresasBD();
            for($i=0;$i<count($empresas);$i++)
            {
                $empresa = $empresas[$i];
                echo "<li>";
                echo "<a href='".$empresa->getWebEmpresa()."'><img src='".$empresa->getLogoEmpresa()."'></a>";
                echo "<h3><p>Nombre: ".$empresa->getNombreEmpresa()."</p><br>";
                echo "<p>Pais: ".$empresa->getPaisEmpresa()."</p><br>";
                echo "<a href='".$empresa->getWebEmpresa()."'>Sitio Web</a><br>";
                echo "<p>Servicios: ".$empresa->getCantidadServicios()."</p><br>";
                echo "<input type='button' value='Ver Servicios' onClick='muestraServicios(".$empresa->getIdEmpresa().");'>";
                echo "</h3>";
                echo "</li>";
            }
            ?>
        </ol>
    </div>
    <?php
}

?>