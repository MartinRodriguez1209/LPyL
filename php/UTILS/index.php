<?php
session_start();
require_once 'registro.php';
require_once 'login.php';

$phpSelf = $_SERVER['PHP_SELF'];

procesarRegistro();
procesarLogin();
procesarCierreSesion();

$usuario    = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;
$logeado    = isset($_SESSION["logeado"]) ? $_SESSION["logeado"] : false;
$primeraVez = !isset($_SESSION["primeraVez"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>IMC</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php if ($primeraVez): ?>
        <?= formRegistro($phpSelf) ?>
    <?php elseif ($logeado): ?>
        <h1>Bienvenido <?= $usuario["nombre"] ?></h1>

        <form method="post" action="<?= $phpSelf ?>">
            <button type="submit" name="cerrarSesion">Cerrar sesion</button>
        </form>
    <?php else: ?>
        <?= formLogin() ?>
    <?php endif; ?>
</body>

</html>