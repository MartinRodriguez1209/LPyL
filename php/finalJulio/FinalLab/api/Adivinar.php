<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

header('Content-Type: application/json');
session_start();

require_once 'Partida.php';

function armarMascara($palabra, $descubiertas)
{
    $mascara = '';
    for ($i = 0; $i < strlen($palabra); $i++) {
        $mascara .= $descubiertas[$i] ? $palabra[$i] : '*';
    }
    return $mascara;
}

if (!isset($_SESSION['partida'])) {
    echo json_encode(['ok' => false, 'mensaje' => 'No hay una partida en curso']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$letra = mb_strtolower($data['letra'], 'UTF-8');

$partida = $_SESSION['partida'];
$palabra = $partida['palabra'];
$descubiertas = $partida['descubiertas'];

// la letra no aporta nada si ya la arriesgaste, o si ya esta visible por una pista
$yaVisible = false;
for ($i = 0; $i < strlen($palabra); $i++) {
    if (mb_strtolower($palabra[$i], 'UTF-8') === $letra && $descubiertas[$i]) {
        $yaVisible = true;
        break;
    }
}

if ($yaVisible || in_array($letra, $partida['letras_arriesgadas'], true)) {
    echo json_encode([
        'ok' => true,
        'yaArriesgada' => true,
        'mascara' => armarMascara($palabra, $descubiertas),
        'puntajeLetras' => $partida['puntaje_letras'],
        'puntajePistas' => $partida['puntaje_pistas'],
        'completada' => false,
    ]);
    exit;
}

// marcar todas las ocurrencias de la letra en la palabra
$acerto = false;
for ($i = 0; $i < strlen($palabra); $i++) {
    if (mb_strtolower($palabra[$i], 'UTF-8') === $letra) {
        $descubiertas[$i] = true;
        $acerto = true;
    }
}

if ($acerto) {
    $partida['puntaje_letras']++;
} else {
    $partida['puntaje_pistas']++;
    // buscar la primera letra no descubierta y revelarla
    for ($i = 0; $i < strlen($palabra); $i++) {
        if (!$descubiertas[$i]) {
            $letraPista = $palabra[$i];
            for ($j = 0; $j < strlen($palabra); $j++) {
                if ($palabra[$j] === $letraPista) {
                    $descubiertas[$j] = true;
                }
            }
            break;
        }
    }
}

// guardar los cambios de vuelta en la sesion
$partida['letras_arriesgadas'][] = $letra;
$partida['descubiertas'] = $descubiertas;
$_SESSION['partida'] = $partida;

// armar la mascara para mostrar en pantalla (letra si esta descubierta, * si no)
$mascara = armarMascara($palabra, $descubiertas);

$completada = !in_array(false, $descubiertas, true);

if ($completada) {
    $puntaje = $partida['puntaje_letras'];
    $multiplicador = ['baja' => 1, 'media' => 2, 'alta' => 3][$partida['dificultad']];
    $gano = $partida['puntaje_letras'] > $partida['puntaje_pistas'];
    $empate = $partida['puntaje_letras'] === $partida['puntaje_pistas'];
    $puntajeAcumulado = ($gano || $empate) ? $puntaje * $multiplicador : 0;
    $resultadoTexto = $gano ? 'ganada' : ($empate ? 'empatada' : 'perdida');
    Partida::guardar($partida['usuario_id'], $palabra, $partida['dificultad'], $partida['puntaje_letras'], $partida['puntaje_pistas'], $puntajeAcumulado, $resultadoTexto);
    unset($_SESSION['partida']);
}

echo json_encode([
    'ok' => true,
    'acerto' => $acerto,
    'mascara' => $mascara,
    'puntajeLetras' => $partida['puntaje_letras'],
    'puntajePistas' => $partida['puntaje_pistas'],
    'completada' => $completada,
    'gano' => $completada ? $gano : null,
    'empate' => $completada ? $empate : null,
    'puntajeAcumulado' => $completada ? $puntajeAcumulado : null,
]);
