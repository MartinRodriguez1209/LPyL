<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once 'Usuario.php';

header('Content-Type: application/json');
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$resultado = Usuario::login($data['usuario'], $data['password']);

if ($resultado['ok']) {
    $_SESSION['usuario_id'] = $resultado['user']->getId();
}

echo json_encode($resultado);
