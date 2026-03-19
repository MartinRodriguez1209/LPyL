<?php
$json = "hola";
include 'palabrasJuego.php';
include 'pistasPalabra.php';

if (isset($_POST['action'])) {
    $palabras = PalabrasJuego::getPalabrasBD();
    $obj = new stdClass();
    $palabra = $palabras[array_rand($palabras)];
    $palabraTemp = new stdClass();
    $palabraTemp->idpalabra = $palabra->getIdPalabra();
    $palabraTemp->nomPalabra = $palabra->getPalabra();
    $palabraTemp->dificultad = $palabra->getDificultadPalabra();
    $palabraTemp->acertada = $palabra->getAcertada();
    $obj->palabra = $palabraTemp;
    $obj->pistas = [];
    $pistas = PistasPalabra::getPistasBD($palabra->getIdPalabra());
    for($i=0;$i<count($pistas);$i++)
    {
        $pista = new stdClass();
        $pista->idPista = $pistas[$i]->getIdPista();
        $pista->pista = $pistas[$i]->getPista();
        $pista->ordenPista = $pistas[$i]->getOrdenPista();
        $obj->pistas[] = $pista;
    }
    $json = json_encode($obj);
}
echo $json;
?>