<?php session_start(); ?>
<html>
<head>
<title>Sesiones - P&aacute;gina de inicio</title>
</head>

<body>
<?php
require_once("Funciones.req.php");
if (isset($_SESSION['usuario']))
{	//El usuario está autenticado. Muestro el menú de opciones
	muestro_menu_opciones();
	muestro_pagina("Inicio");
}
else
{	//El usuario aún no inicio la sesión. Verifico si ingreso los datos o ingresa por primera vez
	if (isset($_POST['boton']) && $_POST['boton']=="Enviar")
	{	//Ingreso los datos. Los verifico
		$nom_usuario = $_POST['usuario'];
		$huella_pass = md5($_POST['clave']);
		if (usuario_valido($nom_usuario, $huella_pass))
		{	//El usuario es válido. Registro la variable de sesión
			$_SESSION['usuario'] = $nom_usuario;
			muestro_menu_opciones();
			muestro_pagina("Inicio");
		}
		else
		{	//No es un usuario válido. Muestro un mensaje de error y el formulario de ingreso de datos
			muestro_form_ingreso("Error en los datos ingresados.<br>Inténtelo nuevamente");
		}
	}
	else
	{	//El usuario está ingresando por primera vez. Muestro el formulario de ingreso de datos
		muestro_form_ingreso("Inicio de sesión");
	}
}
?>
</body>
</html>