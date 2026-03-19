<?php
$json = "hola";
include 'palabrasJuego.php';
include 'pistasPalabra.php';

if (isset($_POST['action'])) {
    $palabras = PalabrasJuego::incrementaAcertadaBD($_POST['action']);
    $obj = new stdClass();
    $obj->acertada = PalabrasJuego::getAcertadaBD($_POST['action']);
    $json = json_encode($obj);
}
echo $json;
?>