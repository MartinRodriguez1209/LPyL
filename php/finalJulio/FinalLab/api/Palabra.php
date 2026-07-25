<?php
require_once 'Db.php';


class Palabra
{
    private String $palabra;

    public function __construct($palabra)
    {
        $this->palabra = $palabra;
    }

    public function getPalabra()
    {
        return $this->palabra;
    }

    public static function obtenerPalabra($dificultad)
    {
        $conexion = conectar();
        $stmt = $conexion->prepare("SELECT palabra FROM palabras WHERE dificultad = ? ORDER BY RAND() LIMIT 1");
        $stmt->bind_param("s", $dificultad);
        try {
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            if ($resultado === null) {
                return ['ok' => false, 'mensaje' => 'No hay palabras para esa dificultad'];
            }
            return ['ok' => true, 'palabra' => new Palabra($resultado['palabra'])];
        } catch (Throwable $th) {
            return ['ok' => false, 'mensaje' => 'Error en el servidor'];
        }
    }
}
