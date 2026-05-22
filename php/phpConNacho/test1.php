<?php
session_start();
require_once("lib/helper.php");
isSessionActive();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {
    ?>
        <div class="dashboard">

            <header>
                <h1>Panel Principal</h1>
                <a href="logout.php" class="logout" id="logout">Cerrar Sesión</a>
            </header>

            <main>
                <div class="box">
                    <h3 id="welcomeText">Bienvenido Usuario</h3>
                    <p id="visitText">Zona privada del sistema.</p>
                    <p id="lastAccessText"></p>
                </div>

                <div class="box">
                    <h3>Configuración</h3>
                    <p>Opciones del sistema.</p>
                </div>
            </main>

        </div>
    <?php
    }
    ?>
</body>
<script src="assets/js/app.js"></script>

</html>