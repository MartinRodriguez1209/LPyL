<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <form method="post" action="index.php">

        <div class="entrada">
            <label for="mascota">Mascota</label>
            <select id="mascota" name="mascota">
                <option value="30">Fox Terrier</option>
                <option value="40">Labrador</option>
                <option value="20">Caniche</option>
                <option value="10">Chihuahua</option>
            </select><br>
        </div>
        <div class="entrada">
            <label for="Cantidad">Cantidad de alimento </label>
            <input type="text" id="Cantidad" name="cantidad"><br>
        </div>
        <div class="entrada">
            <label for="tbolsa">Tipo de bolsa</label>
            <select id="tbolsa" name="bolsa">
                <option value="0.5">1/2 kilogramos</option>
                <option value="1">1 kilogramos</option>
                <option value="3">3 kilogramos</option>
            </select><br>
        </div>
        <div class="entrada">
            <div id="totalbolsas"></div>
        </div>
        <button type="submit">Calcular</button>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cantidad = $_POST["cantidad"];
            $bolsa = $_POST["bolsa"];
            $cantidadBolsas =  ($cantidad * 30) / ($bolsa * 1000);
            echo "<h1> Debe comprar $cantidadBolsas bolsas!</h1>";
        }


        ?>

    </form>

</body>

</html>