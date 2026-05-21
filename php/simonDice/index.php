<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Configuracion del juego</h1>

    <form action="juego.php" method="post">
        <label for="">Nombre:
            <input type="text" name="nombre">
        </label>
        <label for="">Colores en secuencia:
            <input type="number" name="cantidadSecuencia" id="">
        </label>
        <button type="submit" name="comenzarJuego">JUGAR</button>
    </form>
</body>

</html>