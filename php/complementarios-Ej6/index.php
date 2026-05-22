<?php

session_start();
require_once("login.php");
require_once("registro.php");




procesarLogin();
procesarRegistro();
procesarCierreSesion();
if (isset($_COOKIE["usuario"])) {
    $usuario = json_decode($_COOKIE["usuario"], true);
    $_SESSION["usuario"] = $usuario;
    $_SESSION["logeado"] = true;
    header("Location: site.php");
    exit;
}

if (isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true) {

    header("Location: site.php");
    exit;
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
    <?php
    if (!isset($_SESSION["primeraVez"])):
        echo formRegistro();
    else:
        echo formLogin();
    endif;
    ?>
</body>

</html>