<?php
$conexion = new mysqli("localhost", "root", "", "aerolineas");
if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}
$nombre = $_GET['nombreReducido'];
$stmt = $conexion->prepare("SELECT * from modelos inner join aviones on modelos.idmodelo = aviones.idmodelo where nombreReducido = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $aviones = array();

    while ($fila = $resultado->fetch_assoc()) {
        $aviones[] = $fila;
    }

    echo json_encode(array(
        "encontrado" => true,
        "aviones" => $aviones
    ));
} else {
    echo json_encode(array(
        "encontrado" => false
    ));
}

$resultado->free();
$conexion->close();
