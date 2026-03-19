<?php
function cargaJuego()
{
    include 'palabrasJuego.php';
    include 'pistasPalabra.php';
    $palabras = PalabrasJuego::getPalabrasBD();
    $palabra = $palabras[array_rand($palabras)];
    $pistas = PistasPalabra::getPistasBD($palabra->getIdPalabra());
    echo "<input type='hidden' value='".$palabra->getPalabra()."' id='palabraActual'>";
    echo "<input type='hidden' value='".$palabra->getIdPalabra()."' id='idPalabra'>";
    echo "<p>Cantidad de letras: <div id='longitudPalabra'>".strlen($palabra->getPalabra())."</div></p>";
    echo "<p>Dificultad: <div id='dificultaPalabra'>".$palabra->getDificultadPalabra()."</div></p>";
    echo "<p>Veces adivinada: <div id='vecesAdivinada'>".$palabra->getAcertada()."</div></p>";
    echo "<p>Puntaje actual: <div id='puntajeActual'>80</div></p>";
    ?>
    <div id="pistas-contenedor" class="tabla-scroll-contenedor">
        <input type="text" placeholder="Ingrese la palabra" id="inputPalabra" value="">
        <table class="tabla-moderna">
            <caption><p>Pistas Disponibles: <div id="cantPistas">5</div></p> </caption>
            <thead><tr><input type="hidden" value="0" name="numpista" id="numpista"><input type="button" value="Pista" onClick="muestraPista(numpista);" id="btnPista"></tr></thead>
            <tbody id="pistasVisibles">
                <?php
                for($i=0;$i<count($pistas);$i++)
                {
                    echo "<tr id='idpista".$pistas[$i]->getOrdenPista()."' class='oculto'>";
                    echo "<td>".$pistas[$i]->getPista()."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <input type="button" value="Arriesgar" onClick="arriesgar();" id='btnArriesga'">
    <input type="button" value="Abandonar" onClick="abandonar();" id='btnAbandona'">
    <div id="resultadoPartida" class="oculto"></div>
    <?php
}
?>