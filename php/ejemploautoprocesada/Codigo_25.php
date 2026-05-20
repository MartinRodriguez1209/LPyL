<!-- Codigo_25.php -->
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8" />
<title>Ejemplo - Página autoprocesada</title>
<link rel="stylesheet" href="Codigo_25.css" />
</head>
<body>
<section>
<article>
<?php
if (!(isset($_POST['btnConsultar']) && ($_POST['btnConsultar']=="Consultar")))
{
?>
<h2>Consulta de vuelos</h2>
<form id="frmPpal" name="frmPpal" method="post" action="Codigo_25.php">
  <table class="tablaFormulario">
    <tr>
      <td class="izquierda">Aeropuerto</td>
      <td class="derecha">
        <select class="cuadroTexto" name="cmbAeropuerto" id="cmbAeropuerto">
          <option value="1">Aeroparque</option>
          <option value="2" selected>Comodoro Rivadavia</option>
          <option value="3">C&oacute;rdoba</option>
          <option value="4">Mendoza</option>
        </select>
	  </td>
    </tr>
    <tr>
      <td class="izquierda">Fecha</td>
      <td class="derecha">
      <input class="cuadroTexto" id="txtFecha" name="txtFecha" type="date">
      </td>
    </tr>
    <tr>
      <td class="izquierda">Tipo de vuelo</td>
      <td class="derecha">
        <input id="rdnTipoOperacion" name="rdnTipoOperacion" type="radio" value="0" checked>Arribos
        <br>
        <input id="rdnTipoOperacion" name="rdnTipoOperacion" type="radio" value="1">Partidas
      </td>
    </tr>
    <tr>
      <td class="izquierda">L&iacute;neas Aereas</td>
      <td class="derecha">
	  <input name="chkAR" type="checkbox" value="1" checked>Aerolineas Argentinas<br>
      <input name="chkAU" type="checkbox" value="1" >Austral Lineas Aereas<br>
      <input name="chk4M" type="checkbox" value="1" >LAN Argentina<br>
      <input name="chkAN" type="checkbox" value="1" >Andes Lineas Aereas
      </td>
    </tr>
    <tr>
      <td class="combinada" colspan="2">
	  <input class="boton" id="btnConsultar" name="btnConsultar" type="submit" value="Consultar"></td>
    </tr>
  </table>
  </form>
<?php
}
else
{	$aux = array();
	$consulta = 'SELECT * FROM vuelos ';
	$consulta .= 'WHERE id_aeropuerto = '.$_POST['cmbAeropuerto'];
	$consulta .= ' AND fecha = "'.$_POST['txtFecha'].'"';
	$consulta .= ' AND tipo_operacion = '.$_POST['rdnTipoOperacion'];
	if ($_POST['chkAR'])
	{	$aux[] = 'linea = 1';	}
	if ($_POST['chkAU'])
	{	$aux[] = 'linea = 2';	}
	if ($_POST['chk4M'])
	{	$aux[] = 'linea = 3';	}
	if ($_POST['chkAN'])
	{	$aux[] = 'linea = 4';	}
	$consulta .= " AND (".implode(" OR ",$aux).")";
	echo "<h2>Consulta a realizar:</h2>";
	echo "<p>".$consulta."</p>";
} ?>
</article>
</section>
</body>
</html>