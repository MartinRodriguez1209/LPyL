<?php
$cantidad = $_POST["cantidad"];
$bolsa = $_POST["bolsa"];

$cantidadBolsas =  ($cantidad * 30) / ($bolsa * 1000);

echo "<h1> Debe comprar $cantidadBolsas bolsas!</h1>";
