<?php
// Opción A: datos hardcodeados (sin base de datos)
$ciudades = array(
    "Argentina" => array("Buenos Aires", "Comodoro Rivadavia", "Trelew"),
    "Francia"   => array("Paris", "Marsella", "Lyon"),
    "Brasil"    => array("Brasilia", "São Paulo", "Río de Janeiro")
);

$pais = $_GET['pais'];

if (isset($ciudades[$pais])) {
    echo json_encode($ciudades[$pais]);
} else {
    echo json_encode(array());
}
