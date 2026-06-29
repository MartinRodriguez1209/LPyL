<?php
require_once("pasaporte.php");
session_start();

$pasaportes = isset($_SESSION["sessionPasaportes"]) ? $_SESSION["sessionPasaportes"] : [];
$verificado = false;
if (isset($_POST["iniciarVerificacion"])) {
    $documento = $_POST["documento"];
    $fechaAlta = $_POST["fechaAlta"];
    $codigoVer = $_POST["codigoVer"];
    $verificado = verificarPasaporte($documento, $fechaAlta, $codigoVer, $pasaportes);
}


function verificarPasaporte($documento, $fechaAlta, $codigoVer,  $pasaportes)
{
    $resultado = false;
    foreach ($pasaportes as $unPasaporte) {

        if (
            $documento == $unPasaporte->getDni() &&
            $fechaAlta == $unPasaporte->getFechaAlta()
            && $codigoVer == $unPasaporte->getCodigoVer()
        ) {
            return $resultado = true;
        }
    }
    echo "<h2>PASAPORTE NO VALIDO</h2>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <head>
        <h2>VERIFICADOR DE PASAPORTES</h2>
    </head>
    <span class="barraBotones">
        <form class="barraBotones" action="index.php" method="post">
            <button type="submit" name="inicio">Inicio</button>
        </form>
        <form action="reportes.php" method="post">
            <button type="submit" name="reportes">Reportes</button>
        </form>
        <form action="verificar.php" method="post">
            <button type="submit" name="verificar">Verificar pasaporte</button>
        </form>
        <form action="index.php" method="post">
            <button type="submit" name="salir">Salir</button>
        </form>
    </span>
    <?php
    if ($verificado)
        echo "<h2>EL PASAPORTE INGRESADO ES VALIDO</h2>"
    ?>

    <form action="verificar.php" method="post">
        <label>Documento
            <input type="number" name="documento">
        </label>
        <label>Fecha alta
            <input type="date" name="fechaAlta">
        </label>
        <label>Codigo verificador
            <input type="number" name="codigoVer">
        </label>
        <button type="submit" name="iniciarVerificacion">VERIFICAR</button>
    </form>

</body>

</html>