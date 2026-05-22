<?php
session_start();
require_once("./lib/helper.php");
$users = getUsers();
//aca va el if que verifica el array de usuarios pero pasa muy rapido
if (count($_POST) > 0) {
    $user = $_POST["usuario"];
    $pass = $_POST["password"];
    if (isset($users[$user]) && $users($user) == $pass) {
        $_SESSION["usuario"] = "Miguel";
    } else {
        $_SESSION["message"] = "usuario no encontrado";
    }
}
//if ($user == "admin" && $pass == "admin") {   
//    $_SESSION["usuario"] = "Miguel";
//}
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
    } else {

    ?>

        <main class="contenedor">
            <form class="card" id="frm_login" method=post action="phpclase.php">
                <h2>Iniciar Sesión</h2>

                <input type="text" placeholder="Usuario o Email" name="usuario" id="usuario" required>
                <input type="password" placeholder="Contraseña" name="password" id="password" required>

                <button type="submit">Ingresar</button>

                <p>No tienes cuenta?</p>
                <a href="registro.html">Registrarse</a>
            </form>
        </main>
    <?php
    }
    ?>
</body>
<script src="assets/js/app.js"></script>

</html>