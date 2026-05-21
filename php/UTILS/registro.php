<?php
function procesarRegistro()
{
    if (!isset($_POST["registro"])) return;

    $_SESSION["usuario"] = [
        "nombre"      => $_POST["nombre"],
        "documento"   => $_POST["documento"],
        "contrasenia" => $_POST["contrasenia"]
    ];
    $_SESSION["primeraVez"] = false;
    $_SESSION["logeado"]    = true;
}

function formRegistro($phpSelf)
{
    return <<<html
    <div class="contenedor">
        <form method="post" action="$phpSelf">
            <label>Ingrese su nombre completo
                <input required type="text" name="nombre">
            </label>
            <label>Ingrese su numero de documento
                <input required type="number" name="documento">
            </label>
            <label>Ingrese su contraseña
                <input required type="password" name="contrasenia">
            </label>
            <button type="submit" name="registro">Crear cuenta</button>
        </form>
    </div>
html;
}
