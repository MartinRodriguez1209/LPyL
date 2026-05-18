<?php

if (!isset($_POST["nombre"])) {
    header("Location: index.php");
    exit;
}

$nombre = $_POST["nombre"];

$visitas = isset($_COOKIE[$nombre]) ? $_COOKIE[$nombre] : 0;
$visitas++;
setcookie($nombre, $visitas) ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido</h1>
    <h2>Hola <?php echo $nombre ?> esta es tu visita numero: <?php echo $visitas ?></h2>
</body>

</html>


</html>