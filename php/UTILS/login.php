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
    }
}

function procesarCierreSesion()
{
    if (!isset($_POST["cerrarSesion"])) return;
    $_SESSION["logeado"] = false;
}

function formLogin($phpSelf)
{
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
            <button type="submit" name="login">Iniciar sesion</button>
        </form>
    </div>
html;
}
