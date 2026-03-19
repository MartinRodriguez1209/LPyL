<?php

function ingresoModelo()
{
    ?>
    <form id="formularioModelo">
        
        <label for="IDinputModelo">Ingresa el modelo: </label>
        <input type="text" id="IDinputModelo" name="inputModelo" placeholder="Ingresa un modelo" required size="30" list="contenedorSugerencias" onKeyUp="muestraSugerencias();">
        <datalist id="contenedorSugerencias" class="oculto"></datalist>
        
        <input type="button" value="Aceptar" onClick="cargaDatos();">
        <div id="modeloValido" class="oculto"></div><br>
    </form>
    <?php
}

?>