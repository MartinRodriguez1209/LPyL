<!-- Codigo_26.php -->
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8" />
<title>Ejemplo - Upload de archivos</title>
</head>
<body>
<?php
if (isset($_POST['btnEnviar']) && $_POST['btnEnviar']=="Enviar")
{	if (isset($_FILES['txtArchivo']))
	{	include_once("Codigo_26.class.php");
		$archivoSubido = new archivo($_FILES['txtArchivo']['name']);
		$archivoSubido->setTipo($_FILES['txtArchivo']['type']);
		$archivoSubido->setTamanio($_FILES['txtArchivo']['size']);
		$archivoSubido->setNombreTemporal($_FILES['txtArchivo']['tmp_name']);
		echo "Se recibio un archivo con las siguientes características:";
		echo "<br>Nombre: ".$archivoSubido->getNombre();
		echo "<br>Tipo: ".$archivoSubido->getTipo();
		echo "<br>Tamaño: ".$archivoSubido->getTamanio();
		echo "<br>Ubicación temporal: ".$archivoSubido->getNombreTemporal();
		$destino = "Recibidos/".$archivoSubido->getNombre();
		if ($archivoSubido->moverArchivo($destino))
		{	echo "<br>El archivo recibido está en la carpeta 'Recibidos'";	}
		else
		{	echo "<br>Error. No fue posible guardar el archivo enviado";	}
	}
	else
	{	echo "No se recibio el archivo";	}
}
else
{
?>
<form action="<?php echo $PHP_SELF; ?>" method="post" enctype="multipart/form-data" name="frmPpal" id="frmPpal">
Seleccione el archivo a enviar al servidor: <input id="txtArchivo" name="txtArchivo" type="file">
<input name="btnEnviar" type="submit" id="btnEnviar" value="Enviar">
</form>
<?php } ?>
</body>
</html>