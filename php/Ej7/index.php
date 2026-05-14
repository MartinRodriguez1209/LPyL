<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Centro de Llamadas</h1>

    <?php
    if (isset($_POST["destino"]) && isset($_POST["minutos"])) {
        $precios = [
            "local" => 15,
            "nacional"  => 25,
            "internacional" => 80,
            "celular" => 35
        ];
        $minutos = $_POST["minutos"];
        $precioHora = $precios[$_POST["destino"]];
        $precioTotalLlamada = ($minutos < 3) ? 45 : $minutos * $precioHora;
        echo "<h2>Total a pagar: $precioTotalLlamada$ por una llamada de $minutos minutos con destino {$_POST["destino"]}</h2>";
    }
    ?>

    <form method="post" action="index.php">

        <label for="destino">Destino</label>
        <select id="destino" name="destino" required>
            <option value="">-- Seleccionar destino --</option>
            <option value="local">Local — $15.00/min</option>
            <option value="nacional">Nacional — $25.00/min</option>
            <option value="internacional">Internacional — $80.00/min</option>
            <option value="celular">Celular — $35.00/min</option>
        </select><br>

        <label for="minutos">Cantidad de minutos</label>
        <input type="number" id="minutos" name="minutos" min="1" required><br>

        <button type="submit">Calcular</button>

    </form>
</body>

</html>