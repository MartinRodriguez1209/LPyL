<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="entrega.php">

        <h2>Menú</h2>

        <table>
            <tr>
                <th>Pizza</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
            <tr>
                <td>Muzzarella</td>
                <td><img src="muzzarella.jpg" alt="Muzzarella" width="100"></td>
                <td>$1500</td>
                <td><input type="number" name="cantidades[muzzarella]" min="0" value="0"></td>
            </tr>
            <tr>
                <td>Napolitana</td>
                <td><img src="napolitana.jpg" alt="Napolitana" width="100"></td>
                <td>$1800</td>
                <td><input type="number" name="cantidades[napolitana]" min="0" value="0"></td>
            </tr>
            <tr>
                <td>Fugazzeta</td>
                <td><img src="fugazzeta.jpg" alt="Fugazzeta" width="100"></td>
                <td>$1700</td>
                <td><input type="number" name="cantidades[fugazzeta]" min="0" value="0"></td>
            </tr>
            <tr>
                <td>Especial</td>
                <td><img src="especial.jpg" alt="Especial" width="100"></td>
                <td>$2200</td>
                <td><input type="number" name="cantidades[especial]" min="0" value="0"></td>
            </tr>
        </table>

        <h2>Entrega</h2>

        <label>
            <input type="radio" name="entrega" value="retiro" required>
            Retiro en el local
        </label><br>

        <label>
            <input type="radio" name="entrega" value="domicilio">
            Entrega a domicilio
        </label><br>

        <div id="domicilio" style="display:none">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion"><br>

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono"><br>
        </div>

        <button type="submit">Confirmar pedido</button>

    </form>

</body>

</html>