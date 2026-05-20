<?php session_start();	?>
<html>
<head>
<title>Sesiones - P&aacute;gina 2</title>
</head>

<body>
<?php
require_once("Funciones.req.php");
if (isset($_SESSION['usuario']))
{	//El usuario está autenticado, por lo tanto puede acceder a la página 
	muestro_menu_opciones();
	muestro_pagina("Página 2");
}
else
{	//No es un usuario válido. Muestro vínculo para que inicie sesión
	muestro_mensaje_usuario_no_valido();
}

?>
</body>
</html>
