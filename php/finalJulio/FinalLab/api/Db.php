<?php
function conectar()
{
    $conexion = new mysqli("localhost", "root", "", "final_juego_ahorcado");
    $conexion->set_charset("utf8mb4");
    return $conexion;
}
