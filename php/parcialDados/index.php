<?php
require_once 'Partida.php';
session_start();


$turno = [];
$tablaTurnos = '';
if (isset($_SESSION["partida"])) {
    $partida = ($_SESSION["partida"]);
} else {
    $partida = new Partida();
}

if (isset($_SESSION["turnos"])) {
    $historialTurnos = $_SESSION["turnos"];
}

if (isset($_POST["accion"])) {
    if ($_POST["accion"] == "tirar") {
        if (!$partida->termino()) {
            $partida->tiradaJugador();
            $historialTurnos[] = mostrarTurno($partida);
            if (!$partida->termino()) {
                $partida->tiradaCpu();
                $historialTurnos[] = mostrarTurno($partida);
            } else {
                echo "<h2>TERMINO LA PARTIDA</h2>";
                echo "<h2>GANADOR: " . $partida->ganador() . "</h2>";
            }
            $_SESSION["turnos"] = $historialTurnos;
            $_SESSION["partida"] = $partida;
        } else {
            echo "<h2>TERMINO LA PARTIDA</h2>";
            echo "<h2>GANADOR: " . $partida->ganador() . "</h2>";
            echo "<h1>DEBES INICIAR UNA NUEVA PARTIDA</h1>";
        }
    } else if (($_POST["accion"] == "nuevo")) {
        unset($_SESSION["turnos"]);
        unset($_SESSION["partida"]);
        header("Refresh:0");
    }
}



function mostrarTurno($partida)
{
    $turno = $partida->datosPartida();
    return " <tr>
            <td>" . $turno["turnoActual"] . "</td>
            <td>" . $turno["jugadorActual"] . "</td>
            <td>" . $turno["ultimaTirada"] . "</td>
            <td>" . $turno["puntosJugador"] . "</td>
            <td>" . $turno["puntosCpu"] . "</td>
        </tr>";
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
    <table>
        <tr>
            <th>Tirada</th>
            <th>Jugador actual</th>
            <th>Valor de dado</th>
            <th>Jugador</th>
            <th>Compu</th>
        </tr>
        <?php if (isset($historialTurnos)) {
            foreach ($historialTurnos as $turno) {
                echo $turno;
            }
        } ?>

    </table>
    <form method="post" action="index.php">
        <button type="submit" name="accion" value="tirar">Tirar</button>
        <button type="submit" name="accion" value="nuevo">Nuevo Juego</button>
        <button type="submit" name="accion" value="abandonar">Abandonar</button>
    </form>
</body>

</html>