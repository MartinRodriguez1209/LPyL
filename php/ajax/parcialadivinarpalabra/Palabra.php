<?php
session_start();
class Palabra
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli("localhost", "root", "", "juego_palabras_2024");
        if ($this->conexion->connect_error) {
            die("Error: " . $this->conexion->connect_error);
        }
    }

    function setearPalabra()
    {


        $stmt = $this->conexion->prepare("SELECT * FROM palabras ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $palabraObtenida = $stmt->get_result()->fetch_assoc();
        $_SESSION["palabraActual"] =   $palabraObtenida;
        $_SESSION["pistaActual"] = 1;
        $resultado = json_encode(array(
            "cantLetras"      => strlen($palabraObtenida["palabra"]),
            "dificultad"      => $palabraObtenida["dificultadPalabra"],
            "vecesAdivinada"  => $palabraObtenida["acertada"]
        ));
        return $resultado;
    }

    function obtenerPista()
    {
        if (isset($_SESSION["palabraActual"])) {

            $pistaActual = isset($_SESSION["pistaActual"]) ? $_SESSION["pistaActual"] : 1;
            $_SESSION["pistaActual"] = $pistaActual + 1;
            $stmt =  $this->conexion->prepare("SELECT * FROM pistas where idPalabra = ? and ordenPista = ?");
            $stmt->bind_param("ii", $_SESSION["palabraActual"]["idPalabra"], $pistaActual);
            $stmt->execute();
            $pistaObtenida = $stmt->get_result()->fetch_assoc();
            return json_encode($pistaObtenida);
        }
    }

    function verificarPalabra($palabraArriesgada)
    {
        if (strtolower($palabraArriesgada) == strtolower($_SESSION["palabraActual"]["palabra"])) {

            $stmt = $this->conexion->prepare("UPDATE palabras SET acertada = acertada + 1 WHERE idPalabra = ?");
            $stmt->bind_param("i", $_SESSION["palabraActual"]["idPalabra"]);
            $stmt->execute();
            return json_encode(true);
        }
        return json_encode(false);
    }
    function abandonar()
    {
        session_unset();
        session_destroy();
    }
}

$palabra = new Palabra();
if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    if ($accion == "nueva") {
        echo $palabra->setearPalabra();
    } else if ($accion == "pista") {
        echo  $palabra->obtenerPista();
    } else if ($accion == "arriesgar") {
        echo  $palabra->verificarPalabra($_POST["palabraIngresada"]);
    } else if ($accion == "abandonar") {
        $palabra->abandonar();
    }
};
