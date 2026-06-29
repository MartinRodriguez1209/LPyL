<?php
require_once("pasaporte.php");

session_start();

require_once("login.php");
require_once("pasaporte.php");
require_once("pasaporteGenerador.php");
procesarLogin();
procesarCierreSesion();
if (generarPasaporte())
    echo "<h1>PASAPORTE GENERADO</h1>";




$logeado    = isset($_SESSION["logeado"]) ? $_SESSION["logeado"] : false;
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
    <?php if (!$logeado) {
        echo formLogin();
    } else {
    ?>
        <header>
            <h1>Bienvenido al administrador de pasaportes</h1>
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
            <form action="index.php" method="post" id="idFormPasaporte">
                <span><label for="idNombre">Nombre: <input type="text" name="nombre" id="idNombre" required />
                    </label>
                </span>
                <span><label for="idApellido">Apellido
                        <input required type="text" name="apellido" id="idApellido" /></label>
                </span>
                <span><label for="">Numero de documento
                        <input
                            type="number"
                            name="numeroDocumento"
                            id="idNumeroDocumento"
                            required /></label>
                </span>
                <span>
                    <label for="">Fecha de nacimiento
                        <input
                            type="date"
                            name="fechaNacimiento"
                            id="idFechaNacimiento"
                            required /></label></span>
                <span><label for="">Genero
                        <input
                            type="radio"
                            value="masculino"
                            name="genero"
                            id="idGenero"
                            required />Masculino
                        <input
                            type="radio"
                            value="femenino"
                            name="genero"
                            id="idGenero"
                            required />Femenino
                        <input type="radio" value="otro" name="genero" id="idGenero" />
                        otro</label></span>
                <span><label for="">Pais de origen
                        <select name="paisOrigen" id="idPaisOrigen" required>
                            <option value="argentina">Argentina</option>
                            <option value="brasil">Brasil</option>
                            <option value="chile">Chile</option>
                            <option value="colombia">Colombia</option>
                            <option value="peru">Peru</option>
                            <option value="uruguay">Uruguay</option>
                        </select></label></span>
                <span><label for="">Renueva el pasaporte?
                        <select name="opcionRenovar" id="idOpcionRenovar" required>
                            <option value="renovar">Si renovar</option>
                            <option value="noRenovar">No renovar (nuevo pasaporte)</option>
                        </select></label></span>
                <span><input type="reset" value="Resetear" /><button
                        type="submit"
                        value="Generar Pasaporte"
                        name="generarPasaporte">
                        Generar Pasaporte
                    </button>
                </span>
            </form>

        </header>

    <?php
    }

    ?>
</body>

</html>