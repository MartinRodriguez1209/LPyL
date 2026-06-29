<?php



function generarPasaporte()
{
    if (isset($_POST["generarPasaporte"])) {
        $renovar = $_POST["opcionRenovar"] == "renovar";
        $sessionPasaportes = isset($_SESSION["sessionPasaportes"]) ? $_SESSION["sessionPasaportes"] : [];
        $pasaporte = new Pasaporte(
            $_POST["nombre"],
            $_POST["apellido"],
            $_POST["numeroDocumento"],
            $_POST["fechaNacimiento"],
            $_POST["genero"],
            $_POST["paisOrigen"],
            $renovar
        );
        $sessionPasaportes[] = $pasaporte;
        $_SESSION["sessionPasaportes"] =  $sessionPasaportes;
        return true;
    }
}
