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

    public static function obtenerRanking()
    {
        $conexion = conectar();
        $resultado = $conexion->query(
            "SELECT usuarios.nombre_usuario, SUM(partidas.puntaje_acumulado) as puntaje_total
         FROM partidas
         INNER JOIN usuarios ON partidas.usuario_id = usuarios.id
         GROUP BY partidas.usuario_id
         ORDER BY SUM(partidas.puntaje_acumulado) DESC
         LIMIT 10"
        );
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
