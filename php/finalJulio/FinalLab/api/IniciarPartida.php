<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

header('Content-Type: application/json');
require_once 'Palabra.php';

session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['ok' => false, 'mensaje' => 'No hay sesión iniciada']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$dificultad = $data['dificultad'];
$usuarioId = $_SESSION['usuario_id'];

$resultado = Palabra::obtenerPalabra($dificultad);
if (!$resultado['ok']) {
    echo json_encode($resultado);
    exit;
}
$palabra = $resultado['palabra']->getPalabra();

$_SESSION['partida'] = [
    'usuario_id' => $usuarioId,
    'palabra' => $palabra,
    'descubiertas' => array_fill(0, strlen($palabra), false),
    'letras_arriesgadas' => [],
    'puntaje_letras' => 0,
    'puntaje_pistas' => 0,
    'dificultad' => $dificultad,
];

echo json_encode([
    'ok' => true,
    'cantidadLetras' => strlen($palabra),
    'dificultad' => $dificultad,
]);
