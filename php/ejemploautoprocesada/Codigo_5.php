<!-- Codigo_5.php -->
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8" />
<title>Ejemplo - Página autoprocesada</title>
</head>
<body>
<?php
if (isset($_POST['txtNombre']) && isset($_POST['txtEdad']))
{	include_once("Codigo_5.class.php");
	$usuario = new persona($_POST['txtNombre'], $_POST['txtEdad']);
	echo "<h2>Datos recibidos:</h2>";
	echo "Nombre: ".$usuario->getNombre()."<br>";
	echo "Edad: ".$usuario->getEdad()."<br>";
	echo "Has vivido ".$usuario->getDiasVividos()." días!!"; }
else
{
?>
<h2>Introduzca los siguientes datos:</h2>
<form id="frmPpal" name="frmPpal" method="post" action="Codigo_5.php">
  <p>Nombre: <input id="txtNombre" name="txtNombre" type="text" size="30"></p>
  <p>Edad: <input id="txtEdad" name="txtEdad" type="number" size="5">
  <input id="btnEnviar" type="submit" name="btnEnviar" value="Enviar"></p>
</form>
<?php
}
?>
</body>
</html>