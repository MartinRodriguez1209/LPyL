<?php
require_once 'Db.php';


class Palabra
{
    private String $palabra;
    private String $dificultad;

    public function __construct($palabra, $dificultad)
    {
        $this->palabra = $palabra;
        $this->dificultad = $dificultad;
    }

    public function getPalabra()
    {
        return $this->palabra;
    }

    public function getDificultad()
    {
        return $this->dificultad;
    }

    public static function obtenerPalabra($dificultad)
    {
        $conexion = conectar();
        $stmt = $conexion->prepare("SELECT * FROM palabras WHERE dificultad = ? ORDER BY RAND() LIMIT 1");
        $stmt->bind_param("s", $dificultad);
        try {
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            if ($resultado === null) {
                return ['ok' => false, 'mensaje' => 'No hay palabras para esa dificultad'];
            }
            return ['ok' => true, 'palabra' => new Palabra($resultado['palabra'], $resultado['dificultad'])];
        } catch (Throwable $th) {
            return ['ok' => false, 'mensaje' => 'Error en el servidor'];
        }
    }
}
