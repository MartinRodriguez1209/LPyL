<?php
session_start();
if (!isset($_SESSION["entrega"])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST["entrega"])) {
    $_SESSION["cantidades"] = $_POST["cantidades"];
    $_SESSION["entrega"] = $_POST["entrega"];
}
if (isset($_POST["direccion"])) {
    $_SESSION["direccion"] = $_POST["direccion"];
}



function mostrarPedido()
{
    $detallePedido =  $_SESSION["cantidades"];
    echo "<h2>Su pedido:</h2>";
    foreach ($detallePedido as $key => $value) {
        echo "<h3> $key : $value</h3>";
    }
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
    if ($_SESSION["entrega"] == "retiro") {
        echo "<h2>Retirar su pizza en 1 hora en el local</h2>";
        mostrarPedido();
        session_destroy();
    } else {
        if (!empty($_SESSION["direccion"])) {
            echo "<h3>sera enviado a tu dir: {$_SESSION["direccion"]} en 30 minutos </h3>";
            mostrarPedido();
            session_destroy();
        } else { ?> <form action="entrega.php" method="post"><label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion"><br>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono"><br>
                <button type="submit">Confirmar direccion</button>
            </form> <?php
                }
            } ?>

</body>

</html>