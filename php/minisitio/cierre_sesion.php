<?php session_start();	?>
<html>
<head>
<title>Sesiones - P&aacute;gina 1</title>
</head>

<body>
<?php
require_once("Funciones.req.php");
if (isset($_SESSION['usuario']))
{	//El usuario está autenticado, por lo tanto se puede cerrar la sesion 
	$_SESSION[] = array();
	session_destroy();
	muestro_mensaje_cierre_sesion();
}
else
{	//No es un usuario válido. Muestro vínculo para que inicie sesión
	muestro_mensaje_usuario_no_valido();
}

?>
</body>
</html>
