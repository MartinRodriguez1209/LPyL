<?php


function getAvionesFabricante()
{
    $conexion = new mysqli("localhost", "root", "", "avionesargentinos");
    if ($conexion->connect_error) {
        die("Error: " . $conexion->connect_error);
    }
    if (!isset($_POST["base"])) {
        $stmt = $conexion->prepare("SELECT * FROM aviones INNER JOIN empresas on aviones.idEmpresa = empresas.idEmpresa WHERE fabricanteAvion = ?");
        $stmt->bind_param("s", $_POST["fabricante"]);
    } else if (!isset($_POST["fabricante"])) {
        $stmt = $conexion->prepare("SELECT * FROM aviones INNER JOIN empresas on aviones.idEmpresa = empresas.idEmpresa WHERE baseAvion = ?");
        $stmt->bind_param("s", $_POST["base"]);
    } else {
        $stmt = $conexion->prepare("SELECT * FROM aviones INNER JOIN empresas on aviones.idEmpresa = empresas.idEmpresa  WHERE fabricanteAvion = ? AND baseAvion = ?");
        $stmt->bind_param("ss", $_POST["fabricante"], $_POST["base"]);
    }

    $stmt->execute();
    $aviones = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    echo json_encode($aviones);
}

function getInfoAvion()
{
    $conexion = new mysqli("localhost", "root", "", "avionesargentinos");
    if ($conexion->connect_error) {
        die("Error: " . $conexion->connect_error);
    }
    $stmt = $conexion->prepare("SELECT * FROM aviones INNER JOIN empresas on aviones.idEmpresa = empresas.idEmpresa WHERE idAvion = ?");
    $stmt->bind_param("i", $_POST["idAvion"]);
    $stmt->execute();
    $aviones = $stmt->get_result()->fetch_assoc();
    echo json_encode($aviones);
}

if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    if ($accion == "getFabricantes") {
        getFabricantes();
    }
    if ($accion == "getBases") {
        getBases();
    }
    if ($accion == "getAvionesFabricante") {
        getAvionesFabricante();
    }
    if ($accion == "getInfoAvion") {
        getInfoAvion();
    }
}

function getFabricantes()
{
    $conexion = new mysqli("localhost", "root", "", "avionesargentinos");
    if ($conexion->connect_error) {
        die("Error: " . $conexion->connect_error);
    }
    $stmt = $conexion->prepare("SELECT DISTINCT fabricanteAvion FROM aviones ");
    $stmt->execute();
    $aviones = $stmt->get_result()->fetch_all();
    echo json_encode($aviones);
}

function getBases()
{
    $conexion = new mysqli("localhost", "root", "", "avionesargentinos");
    if ($conexion->connect_error) {
        die("Error: " . $conexion->connect_error);
    }
    $stmt = $conexion->prepare("SELECT DISTINCT baseAvion FROM aviones ");
    $stmt->execute();
    $bases = $stmt->get_result()->fetch_all();
    echo json_encode($bases);
}
