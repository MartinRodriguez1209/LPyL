<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

header('Content-Type: application/json');
require_once 'Partida.php';
session_start();

$partida = $_SESSION['partida'];

Partida::guardar(
    $partida['usuario_id'],
    $partida['palabra'],
    $partida['dificultad'],
    $partida['puntaje_letras'],
    $partida['puntaje_pistas'],
    0,
    'perdida'
);

unset($_SESSION['partida']);

echo json_encode(['ok' => true]);
