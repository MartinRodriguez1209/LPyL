<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["sexo"]) && isset($_POST["nacimiento"]) && isset($_POST["telefono"]) && isset($_POST["email"]) && isset($_POST["eventos"])) {
        $nacimiento = new DateTime($_POST["nacimiento"]);
        $hoy = new DateTime("today");
        $edad = $hoy->diff($nacimiento)->y;
        if ($edad >= 18) {
            echo "<h2> Nombre: {$_POST["nombre"]} {$_POST["apellido"]}  </h2>";
            echo "<h2>Genero: {$_POST["sexo"]}</h2>";
            echo "<h2>Edad: {$edad}</h2>";
            echo "<h2>Telefono: {$_POST["telefono"]}</h2>";
            echo "<h2>Email: {$_POST["email"]}</h2>";
            echo "<p>Eventos: " . implode(", ", $_POST["eventos"]) . "</p>";
            echo "<h2>La subscripcion se realizo correctamente</h2>";
        } else {
            echo "<h2>Debes ser mayor de edad para subscribirte!</h2>";
            echo "<a href='index.php'>Volver al formulario</a>";
        }
    } else {
    ?><form method="post" action="index.php">
            <h1>Ejercicio 6</h1>


            <h2>Datos Personales</h2>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" required><br>

            <label for="sexo">Genero</label>
            <select id="sexo" name="sexo" required>
                <option value="">-- Seleccionar --</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                <option value="O">Otro</option>
            </select><br>

            <label for="nacimiento">Fecha de Nacimiento</label>
            <input type="date" id="nacimiento" name="nacimiento" required><br>

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" required><br>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required><br>

            <h2>Eventos</h2>

            <label>
                <input type="checkbox" name="eventos[]" value="tenis">
                Torneo de Tenis — 15/06/2025 — Gimnasio Municipal
            </label><br>

            <label>
                <input type="checkbox" name="eventos[]" value="ajedrez">
                Campeonato de Ajedrez — 22/06/2025 — Club Universitario
            </label><br>

            <label>
                <input type="checkbox" name="eventos[]" value="escolares">
                Competencias Escolares — 30/06/2025 — Estadio UNPSJB
            </label><br>

            <label>
                <input type="checkbox" name="eventos[]" value="atletismo">
                Torneo de Atletismo — 10/07/2025 — Pista Municipal
            </label><br>

            <button type="submit">Suscribirse</button>

        </form> <?php
            }
                ?>

</body>

</html>