<?php
session_start();

$logeado = isset($_SESSION["logeado"]) ? $_SESSION["logeado"] : false;
$primeraVez = !isset($_SESSION["primeraVez"]);
$phpSelf = $_SERVER['PHP_SELF'];
$formCrearCuenta = <<<html
    <div class="contenedor">
        <form method="post" action="$phpSelf" name="crearCuentaForm">
            <label>Ingrese su nombre completo
                <input required type="text" name="nombre" id="">
            </label>
            <label>Ingrese su numero de documento
                <input required type="number" name="documento" id="">
            </label>
            <label>Ingrese su contraseña
                <input required type="password" name="contrasenia" id="">
            </label>
            <button type="submit" name="registro">Crear cuenta</button>
        </form>
    </div> 
html;

$formLogin = <<<html
    <form method="post" action="$phpSelf">
        <h2>LOGIN</h2>
        <label>Ingrese su documento
            <input type="number" name="documento">
        </label>
        <label>Ingrese su contraseña
            <input type="password" name="contrasenia">
        </label>
        <button type="submit" name="login">Iniciar sesion</button>
    </form>
html;


if (isset($_POST["registro"])) {
    $usuario = [
        "nombre" => $_POST["nombre"],
        "documento" => $_POST["documento"],
        "contrasenia" => $_POST["contrasenia"]
    ];
    $_SESSION["usuario"] = $usuario;
    $primeraVez = false;
    $_SESSION["primeraVez"] = $primeraVez;
    $logeado = true;
    $_SESSION["logeado"] =    $logeado;
}
$usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;

if (isset($_POST["login"])) {
    if ($_POST["documento"] == $usuario["documento"] && $_POST["contrasenia"] == $usuario["contrasenia"]) {
        $logeado = true;
        $_SESSION["logeado"] =    $logeado;
    }
}

if (isset($_POST["cerrarSesion"])) {
    $logeado = false;
    $_SESSION["logeado"] =    $logeado;
}
function nivelPeso($imc)
{
    if ($imc < 18.5) return "Valores de bajo peso";
    if ($imc < 24.90) return "Valores de peso normal";
    if ($imc < 29.90) return "Valores de sobrepeso";
    return "Valores de obesidad";
}

function mostrarResultado($resultadoImc, $historial)
{
    echo "<h3>Nombre del paciente: " .  $resultadoImc["nombre"] . "</h3>";
    echo "<h3>Peso: " .  $resultadoImc["peso"] . "</h3>";
    echo "<h3>Estatura: " .  $resultadoImc["altura"] . "</h3>";
    echo "<h3>IMC: " .  $resultadoImc["imc"] . "</h3>";
    echo "<h3>Resultado: " .  $resultadoImc["valor"] . "</h3>"; {
?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>IMC</th>
                <th>RESULTADO</th>
            </tr>
            <?php foreach ($historial as  $calculo) {
                echo "<tr> <td>" . $calculo["nombre"] . "</td> <td> " . $calculo["imc"] . " </td> <td>  " . $calculo["valor"] . "</td></tr>";
            } ?>
        </table>
<?php
    }
}

if (isset($_POST["calcular"])) {
    $nombreCalculo = $_POST["nombreCalculadora"];
    $pesoCalculo = $_POST["pesoCalculadora"];
    $alturaCalculo = $_POST["alturaCalculadora"];
    $imc = $pesoCalculo / (($alturaCalculo / 100) * ($alturaCalculo / 100));
    $valor = nivelPeso($imc);
    $resultadoImc = [
        "nombre" => $nombreCalculo,
        "peso" => $pesoCalculo,
        "altura" => $alturaCalculo,
        "imc" => $imc,
        "valor" => $valor
    ];
    $historial = isset($_SESSION["historialImc"]) ? $_SESSION["historialImc"] : [];
    $historial[] = $resultadoImc;
    $_SESSION["historialImc"] = $historial;
    mostrarResultado($resultadoImc, $historial);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php if ($primeraVez) {
        echo $formCrearCuenta;
    } else if ($logeado) {
        echo "<h1>Bienvenido " . $usuario["nombre"] . "</h1>";
    ?>
        <h2>CALCULADORA DE IMC</h2>
        <div class="contenedor">
            <form action="<?= $phpSelf ?>" method="post">
                <label>Nombre:
                    <input type="text" name="nombreCalculadora" id="">
                </label>
                <label>Peso(KG)
                    <input type="number" name="pesoCalculadora" id="">
                </label>
                <label>Altura(CM)
                    <input type="number" name="alturaCalculadora" id="">
                </label>
                <button type="submit" name="calcular">Calcular</button>
            </form>
        </div>

        <form action="<?= $phpSelf ?>" method="post">
            <span>

                <button type="submit" name="cerrarSesion">Cerrar sesion</button>
            </span>

        </form>

    <?php
    } else {
        echo $formLogin;
    } ?>


</body>

</html>