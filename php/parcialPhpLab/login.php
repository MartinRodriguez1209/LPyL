<?php



function procesarLogin()
{
    if (!isset($_POST["login"])) return;
    if (
        $_POST["usuario"] == "admin@gmail.com" &&
        $_POST["contrasenia"] == "#idAmin3278"
    ) {
        $_SESSION["logeado"] = true;
    }
}

function procesarCierreSesion()
{
    if (!isset($_POST["salir"])) return;
    $_SESSION["logeado"] = false;
    session_destroy();
}

function formLogin()
{
    $phpSelf = $_SERVER['PHP_SELF'];
    return <<<html
    <div class="contenedor">
        <form method="post" action="$phpSelf">
            <h2>LOGIN</h2>
            <label>Ingrese su usuario
                <input type="text" name="usuario">
            </label>
            <label>Ingrese su contraseña
                <input type="password" name="contrasenia">
            </label>
            <button type="submit" name="login">Iniciar sesion</button>
        </form>
    </div>
html;
}
