<?php
require_once 'Db.php';

class Partida
{
    public static function guardar($usuarioId, $palabra, $dificultad, $puntajeLetras, $puntajePistas, $puntajeAcumulado, $resultado)
    {
        $conexion = conectar();
        $stmt = $conexion->prepare(
            "INSERT INTO partidas (usuario_id, palabra, dificultad, puntaje_letras, puntaje_pistas, puntaje_acumulado, resultado) VALUES (?,?,?,?,?,?,?)"
        );
        $stmt->bind_param("issiiis", $usuarioId, $palabra, $dificultad, $puntajeLetras, $puntajePistas, $puntajeAcumulado, $resultado);
        $stmt->execute();
    }
}
