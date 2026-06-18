<?php
// ============================================================
// api.php
// Único punto de entrada del lado del servidor. Según el
// parámetro "accion" recibido por GET, responde con:
//
//   ?accion=empresas
//       -> listado de empresas (para poblar el selector)
//
//   ?accion=buscar&idEmpresa=...&dia=...
//       -> listado de servicios filtrados por empresa y/o día
//          (ambos parámetros son opcionales)
//
// Todas las respuestas son JSON.
// ============================================================

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

// ------------------------------------------------------------
// Conexión a la base de datos
// ------------------------------------------------------------
$host    = 'localhost';
$puerto  = '3306';
$bd      = 'MicrosLargaDistancia';
$usuario = 'root';
$clave   = '';

try {
    $conexion = new PDO(
        "mysql:host={$host};port={$puerto};dbname={$bd};charset=utf8mb4",
        $usuario,
        $clave,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $error) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
    exit;
}

// ------------------------------------------------------------
// Router según la acción solicitada
// ------------------------------------------------------------
$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'empresas':
        obtenerEmpresas($conexion);
        break;

    case 'buscar':
        buscarServicios($conexion);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no válida. Use "empresas" o "buscar".']);
        break;
}

// ------------------------------------------------------------
// Devuelve el listado de empresas
// ------------------------------------------------------------
function obtenerEmpresas(PDO $conexion): void
{
    try {
        $consulta = $conexion->query(
            'SELECT idEmpresa, nombreEmpresa FROM EMPRESAS ORDER BY nombreEmpresa ASC'
        );
        echo json_encode($consulta->fetchAll(), JSON_UNESCAPED_UNICODE);
    } catch (PDOException $error) {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudieron obtener las empresas.']);
    }
}

// ------------------------------------------------------------
// Busca servicios según los filtros de empresa y/o día
// ------------------------------------------------------------
function buscarServicios(PDO $conexion): void
{
    // Lista blanca: traduce el código de día recibido del
    // cliente al nombre real de la columna en SERVICIOS. Así
    // evitamos insertar el valor del usuario directamente en
    // el nombre de una columna SQL.
    $columnasPorDia = [
        'LU' => 'operaLU',
        'MA' => 'operaMA',
        'MI' => 'operaMI',
        'JU' => 'operaJU',
        'VI' => 'operaVI',
        'SA' => 'operaSA',
        'DO' => 'operaDO',
    ];

    $nombresDia = [
        'operaLU' => 'Lunes',
        'operaMA' => 'Martes',
        'operaMI' => 'Miércoles',
        'operaJU' => 'Jueves',
        'operaVI' => 'Viernes',
        'operaSA' => 'Sábado',
        'operaDO' => 'Domingo',
    ];

    $idEmpresa = $_GET['idEmpresa'] ?? '';
    $dia       = $_GET['dia'] ?? '';

    $condiciones = [];
    $parametros  = [];

    if ($idEmpresa !== '' && ctype_digit((string) $idEmpresa)) {
        $condiciones[] = 's.idEmpresa = :idEmpresa';
        $parametros[':idEmpresa'] = (int) $idEmpresa;
    }

    if ($dia !== '' && array_key_exists($dia, $columnasPorDia)) {
        $columna = $columnasPorDia[$dia];
        $condiciones[] = "s.{$columna} = 'True'";
    }

    $sql = '
        SELECT
            s.idServicio, s.ciudadOrigen, s.ciudadDestino,
            s.horaSalida, s.horaLlegada,
            s.asientosSemicama, s.precioPasajeSemicama,
            s.asientosCama, s.precioPasajeCama,
            s.operaLU, s.operaMA, s.operaMI, s.operaJU,
            s.operaVI, s.operaSA, s.operaDO,
            e.nombreEmpresa, e.webEmpresa
        FROM SERVICIOS s
        INNER JOIN EMPRESAS e ON e.idEmpresa = s.idEmpresa
    ';

    if (!empty($condiciones)) {
        $sql .= ' WHERE ' . implode(' AND ', $condiciones);
    }

    $sql .= ' ORDER BY s.horaSalida ASC';

    try {
        $consulta = $conexion->prepare($sql);
        foreach ($parametros as $marcador => $valor) {
            $consulta->bindValue($marcador, $valor, PDO::PARAM_INT);
        }
        $consulta->execute();
        $filas = $consulta->fetchAll();

        $servicios = array_map(function (array $fila) use ($nombresDia) {
            $diasOpera = [];
            foreach ($nombresDia as $columna => $nombre) {
                if ($fila[$columna] === 'True') {
                    $diasOpera[] = $nombre;
                }
            }

            return [
                'idServicio'           => (int) $fila['idServicio'],
                'ciudadOrigen'         => $fila['ciudadOrigen'],
                'ciudadDestino'        => $fila['ciudadDestino'],
                'horaSalida'           => substr($fila['horaSalida'], 0, 5),
                'horaLlegada'          => substr($fila['horaLlegada'], 0, 5),
                'asientosSemicama'     => (int) $fila['asientosSemicama'],
                'precioPasajeSemicama' => (int) $fila['precioPasajeSemicama'],
                'asientosCama'         => (int) $fila['asientosCama'],
                'precioPasajeCama'     => (int) $fila['precioPasajeCama'],
                'diasOpera'            => $diasOpera,
                'nombreEmpresa'        => $fila['nombreEmpresa'],
                'webEmpresa'           => $fila['webEmpresa'],
            ];
        }, $filas);

        echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
    } catch (PDOException $error) {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudieron obtener los servicios.']);
    }
}
