<?php
require_once("pasaporte.php");

session_start();

$pasaportes = isset($_SESSION["sessionPasaportes"]) ? $_SESSION["sessionPasaportes"] : [];

function mostrarPasaporte(Pasaporte $pasaporte)
{
    $nombreCompleto = $pasaporte->getNombreCompleto();
    $documento = $pasaporte->getDni();
    $fechaNac = $pasaporte->getFechaNac();
    $pais = $pasaporte->getPais();
    $genero = $pasaporte->getGenero();
    $codigoVer = $pasaporte->getCodigoVer();
    $fechaAlta = $pasaporte->getFechaAlta();
    $renueva = $pasaporte->renueva() ? "SI" : "NO";
    return "    <div class=\"contenedor\">
        <h3>Apellido y nombre: " . "$nombreCompleto" . " </h3>
        <h3>Documento: " . $documento . "</h3>
        <h3>Fecha de nacimiento: " . $fechaNac . "</h3>
        <h3>Pais: " . $pais . "</h3>
        <h3>Genero: " . $genero . "</h3>
        <h3>Fecha alta: " . $fechaAlta . " </h3>
        <h3>Codigo verificador:" . $codigoVer . "</h3>
        <h3>Renueva? " . $renueva . "</h3>
    </div>";
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
    if (count($pasaportes) == 0) {
        echo "<h3>NO HAY PASAPORTES</h3>";
    } else {
        foreach ($pasaportes as $unPasaporte) {
            echo "<h2>Cantidad de pasaportes generados: " . count($pasaportes) . "</h2>";
            echo mostrarPasaporte($unPasaporte);
        }
    } ?>


</body>

</html>