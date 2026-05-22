<?php



function procesarLogin()
{
    if (!isset($_POST["login"])) return;

    $usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;
    if (!$usuario) return;

    if (
        $_POST["documento"] == $usuario["documento"] &&
        $_POST["contrasenia"] == $usuario["contrasenia"]
    ) {
        $_SESSION["logeado"] = true;
        if (isset($_POST["recordarme"])) {
            setcookie("usuario", json_encode($usuario), time() + 60 * 60 * 24 * 30 * 2);
        }
    }
}

function procesarCierreSesion()
{
    if (!isset($_POST["cerrarSesion"])) return;
    $_SESSION["logeado"] = false;
    if (isset($_COOKIE["usuario"])) {
        setcookie("usuario", "", time() - 3600);
        unset($_COOKIE["usuario"]);
    }
    header("Location: index.php");
    exit;
}

function formLogin()
{
    $phpSelf = $_SERVER['PHP_SELF'];
    return <<<html
    <div class="contenedor">
        <form method="post" action="$phpSelf">
            <h2>LOGIN</h2>
            <label>Ingrese su documento
                <input type="number" name="documento">
            </label>
            <label>Ingrese su contraseña
                <input type="password" name="contrasenia">
            </label>
            <label>Recordarme <input type="checkbox" name="recordarme" id=""> </label>
            <button type="submit" name="login">Iniciar sesion</button>
        </form>
        <a href="registroLogin.php">Crear cuenta</a>
    </div>
html;
}
