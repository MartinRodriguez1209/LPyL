<?php
session_start();

if (isset($_POST["RESET"])) {
    session_destroy();
    header("Location: http://localhost/miproyecto/simonDice/");
}

if (isset($_POST["comenzarJuego"])) {
    $_SESSION["turnos"] = 0;
    $nombre = $_POST["nombre"];
    $cantidadSecuencia = $_POST["cantidadSecuencia"];
    $juego = true;
    $_SESSION["juego"] = true;
    $_SESSION["cantidadSecuenciaRestante"] =  $cantidadSecuencia;
} else if (!isset($_SESSION["juego"]) || $_SESSION["juego"] == false) {
    header("Location: http://localhost/miproyecto/simonDice/");
    exit;
}

$cantidadSecuenciaRestante = $_SESSION["cantidadSecuenciaRestante"];
$secuencia = isset($_SESSION["secuencia"]) ? $_SESSION["secuencia"] : [];
$acierto = true;
if (isset($_POST["ingresar"])) {

    $cadenaUsuario = $_POST["color"];
    $secuenciaUsuario = explode("-", $cadenaUsuario);
    for ($i = 0; $i < count($secuencia); $i++) {
        if ($secuenciaUsuario[$i] != $secuencia[$i]["valor"]) {
            $acierto = false;
            terminarPartida(false);
            header("Location: http://localhost/miproyecto/simonDice/derrota.php");
            exit;
        }
    }
}

function terminarPartida($victoria)
{
    session_destroy();
    $partidas = isset($_COOKIE["partidas"]) ? $_COOKIE["partidas"] + 1  : 1;
    setcookie("partidas", $partidas);
    if ($victoria) {
        $victorias = isset($_COOKIE["victorias"]) ? $_COOKIE["victorias"] + 1 : 1;
        setcookie("victorias", $victorias);
    }
}

function generarNuevoColor()
{
    $colores = [
        1 => ["valor" => "R", "nombre" => "Rojo"],
        2 => ["valor" => "A", "nombre" => "Azul"],
        3 => ["valor" => "V", "nombre" => "Verde"],
        4 => ["valor" => "Y", "nombre" => "Amarillo"]
    ];
    return $colores[random_int(1, 4)];
}



if ($cantidadSecuenciaRestante > 0 && $acierto) {
    $secuencia[] =  generarNuevoColor();
    $_SESSION["secuencia"] = $secuencia;
    $cantidadSecuenciaRestante--;
    $_SESSION["cantidadSecuenciaRestante"] =  $cantidadSecuenciaRestante;
} else if ($cantidadSecuenciaRestante == 0) {
    session_destroy();
    terminarPartida(true);
    header("Location: http://localhost/miproyecto/simonDice/victoria.php");
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Jugando a simon dice con: <?= $nombre ?></h2>
    <h2>Color actual: <?= end($secuencia)["nombre"] ?></h2>
    <h2>Colores restantes: <?= $cantidadSecuenciaRestante ?> </h2>
    <form action="juego.php" method="post">
        <label for="">Ingrese la secuencia separada por -
            <input type="text" name="color">
        </label>
        <button type="submit" name="ingresar">INGRESAR</button>
        <button type="submit" name="RESET">RESET</button>
    </form>

</body>

</html>