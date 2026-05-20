<!-- Codigo_122.php -->
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8" />
<title>Página autoprocesada</title>
</head>
<body>
<?php
	if ($_POST['nombre']!="" && $_POST['edad']!="")
	{	
		define ("canti_dias",365);
		echo "Nombre: ".$_POST['nombre']."<br><br>";
		echo "Edad: ".$_POST['edad']."<br><br>";
		echo "Has vivido ".$_POST['edad']*canti_dias." días!!<br>";
		echo '<br><a href="Codigo_122.php">Volver al inicio</a>';
	}
	else
	{
?>
	<section>
		<article>
			<h2>Introduzca los siguientes datos:</h2>
			<form id="form" name="form" method="post" action="Codigo_122.php">
			Nombre: <input name="nombre" type="text" size="30" maxlength="30">
			Edad: <input name="edad" type="text" size="5" maxlength="3">
			<input type="submit" name="Submit" value="Enviar">
			</form>
		</article>
	</section>
<?php
	}
?>
</body>
</html>


