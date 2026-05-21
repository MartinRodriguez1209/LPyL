<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>FELICIDADES GANASTE</h1>
    <?php echo "<h2>Cantidad de partidas jugadas: " . $_COOKIE["partidas"] . "</h2>" ?>
    <?php echo "<h2>Cantidad de partidas ganadas: " . $_COOKIE["victorias"] . "</h2>" ?>
    <form action="index.php" method="post">
        <button type="submit">Volver al inicio</button>
    </form>
</body>

</html>