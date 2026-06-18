<?php
// ============================================================
// UTILS PHP AJAX
// Funciones genéricas para el manejo de AJAX en el servidor
// Extraídas de patrones repetidos en: aviones.php, Palabra.php,
// productos_ajax.php, ciudades.php
// ============================================================


// ─────────────────────────────────────────────
// HEADERS
// ─────────────────────────────────────────────

// Establece el header para indicar que la respuesta es JSON
// Uso: jsonHeader();  — llamar al inicio del script antes de cualquier echo
function jsonHeader() {
    header("Content-Type: application/json; charset=utf-8");
}


// ─────────────────────────────────────────────
// PARÁMETROS HTTP
// ─────────────────────────────────────────────

// Devuelve el valor de un parámetro GET o un default si no existe
// Uso: $pais = getParam("pais");
// Uso: $nombre = getParam("nombreReducido", "");
function getParam($nombre, $default = null) {
    return isset($_GET[$nombre]) ? $_GET[$nombre] : $default;
}

// Devuelve el valor de un parámetro POST o un default si no existe
// Uso: $accion = postParam("accion");
// Uso: $palabra = postParam("palabraIngresada", "");
function postParam($nombre, $default = null) {
    return isset($_POST[$nombre]) ? $_POST[$nombre] : $default;
}

// Verifica que un parámetro POST exista y no esté vacío
// Uso: if (!postRequerido("accion")) { respuestaError("Falta accion"); exit; }
function postRequerido($nombre) {
    return isset($_POST[$nombre]) && $_POST[$nombre] !== "";
}

// Verifica que un parámetro GET exista y no esté vacío
// Uso: if (!getRequerido("pais")) { respuestaError("Falta pais"); exit; }
function getRequerido($nombre) {
    return isset($_GET[$nombre]) && $_GET[$nombre] !== "";
}


// ─────────────────────────────────────────────
// RESPUESTAS JSON
// ─────────────────────────────────────────────

// Devuelve una respuesta JSON de éxito con datos opcionales
// Uso: respuestaOk(array("nombre" => "Juan"))
// Resultado: {"ok":true,"datos":{"nombre":"Juan"}}
function respuestaOk($datos = null) {
    echo json_encode(array(
        "ok"    => true,
        "datos" => $datos
    ));
}

// Devuelve una respuesta JSON de error con un mensaje
// Uso: respuestaError("Cliente no encontrado")
// Resultado: {"ok":false,"error":"Cliente no encontrado"}
function respuestaError($mensaje) {
    echo json_encode(array(
        "ok"    => false,
        "error" => $mensaje
    ));
}

// Respuesta del patrón encontrado/no encontrado (usado en aviones.php)
// Uso: respuestaEncontrado($filas, "aviones")
// Resultado cuando hay datos: {"encontrado":true,"aviones":[...]}
// Resultado cuando no hay datos: {"encontrado":false}
function respuestaEncontrado($datos, $clave = "datos") {
    if ($datos && count($datos) > 0) {
        echo json_encode(array(
            "encontrado" => true,
            $clave       => $datos
        ));
    } else {
        echo json_encode(array("encontrado" => false));
    }
}

// Respuesta booleana simple (usado en Palabra.php para verificar respuesta)
// Uso: respuestaBooleana($palabraCorrecta)
// Resultado: true  o  false
function respuestaBooleana($valor) {
    echo json_encode((bool)$valor);
}


// ─────────────────────────────────────────────
// CONEXIÓN A BASE DE DATOS
// ─────────────────────────────────────────────

// Conecta a la base de datos y devuelve la conexión
// Si falla, responde con JSON de error y detiene la ejecución
// Uso: $con = conectar("localhost", "root", "", "mi_base");
function conectar($host, $usuario, $password, $base) {
    $conexion = new mysqli($host, $usuario, $password, $base);
    if ($conexion->connect_error) {
        respuestaError("Error de conexión: " . $conexion->connect_error);
        exit;
    }
    return $conexion;
}

// Atajo para la conexión local con root sin contraseña (patrón más usado)
// Uso: $con = conectarLocal("aerolineas");
// Uso: $con = conectarLocal("juego_palabras_2024");
// Uso: $con = conectarLocal("computacion");
function conectarLocal($base) {
    return conectar("localhost", "root", "", $base);
}


// ─────────────────────────────────────────────
// CONSULTAS PREPARADAS
// ─────────────────────────────────────────────

// Ejecuta una consulta preparada y devuelve todos los resultados como array
// Uso sin parámetros: fetchTodos($con, "SELECT * FROM productos")
// Uso con parámetros: fetchTodos($con, "SELECT * FROM aviones WHERE modelo = ?", "s", ["B737"])
// Uso con varios params: fetchTodos($con, "SELECT * FROM pistas WHERE idPalabra = ? AND orden = ?", "ii", [3, 1])
function fetchTodos($conexion, $sql, $tipos = null, $params = null) {
    $stmt = $conexion->prepare($sql);
    if ($tipos && $params) {
        $stmt->bind_param($tipos, ...$params);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $filas = array();
    while ($fila = $resultado->fetch_assoc()) {
        $filas[] = $fila;
    }
    $resultado->free();
    return $filas;
}

// Ejecuta una consulta preparada y devuelve solo la primera fila
// Uso: $producto = fetchUno($con, "SELECT * FROM productos WHERE codigo = ?", "i", [42])
// Uso: $usuario = fetchUno($con, "SELECT * FROM usuarios WHERE email = ?", "s", ["a@b.com"])
function fetchUno($conexion, $sql, $tipos = null, $params = null) {
    $stmt = $conexion->prepare($sql);
    if ($tipos && $params) {
        $stmt->bind_param($tipos, ...$params);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();
    $resultado->free();
    return $fila;
}

// Ejecuta una fila aleatoria (patrón ORDER BY RAND() usado en Palabra.php)
// Uso: $palabra = fetchAleatorio($con, "SELECT * FROM palabras")
function fetchAleatorio($conexion, $sql) {
    $sqlRand = rtrim($sql) . " ORDER BY RAND() LIMIT 1";
    return fetchUno($conexion, $sqlRand);
}

// Ejecuta una consulta de acción (INSERT, UPDATE, DELETE)
// Devuelve true si tuvo éxito, false si no
// Uso: ejecutar($con, "DELETE FROM sesiones WHERE id = ?", "i", [5])
// Uso: ejecutar($con, "UPDATE palabras SET acertada = acertada + 1 WHERE idPalabra = ?", "i", [3])
// Uso sin params: ejecutar($con, "TRUNCATE TABLE temp")
function ejecutar($conexion, $sql, $tipos = null, $params = null) {
    $stmt = $conexion->prepare($sql);
    if ($tipos && $params) {
        $stmt->bind_param($tipos, ...$params);
    }
    return $stmt->execute();
}

// Agrupar filas por el valor de una columna clave (patrón de productos_ajax.php)
// Devuelve un array asociativo indexado por el valor de $clave
// Uso: $porCodigo = agruparPor($filas, "codigo")
// Resultado: ["P001" => [...fila...], "P002" => [...fila...]]
function agruparPor($filas, $clave) {
    $agrupado = [];
    foreach ($filas as $fila) {
        $valor = $fila[$clave];
        if (!isset($agrupado[$valor])) {
            $agrupado[$valor] = [];
        }
        $agrupado[$valor][] = $fila;
    }
    return $agrupado;
}


// ─────────────────────────────────────────────
// SESIONES
// ─────────────────────────────────────────────

// Inicia la sesión de forma segura (evita error si ya fue iniciada)
// Uso: sesionInicial();  — llamar al inicio del script
function sesionInicial() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Devuelve el valor de una variable de sesión o un default si no existe
// Uso: $pistaActual = getSesion("pistaActual", 1)
// Uso: $palabra = getSesion("palabraActual")
function getSesion($clave, $default = null) {
    return isset($_SESSION[$clave]) ? $_SESSION[$clave] : $default;
}

// Guarda un valor en la sesión
// Uso: setSesion("palabraActual", $palabraObtenida)
// Uso: setSesion("pistaActual", 1)
function setSesion($clave, $valor) {
    $_SESSION[$clave] = $valor;
}

// Elimina una clave específica de la sesión
// Uso: borrarSesion("palabraActual")
function borrarSesion($clave) {
    unset($_SESSION[$clave]);
}

// Destruye toda la sesión actual (usado en Palabra.php para "abandonar")
// Uso: limpiarSesion()
function limpiarSesion() {
    session_unset();
    session_destroy();
}


// ─────────────────────────────────────────────
// COMPARACIÓN Y VALIDACIÓN DE TEXTO
// ─────────────────────────────────────────────

// Compara dos strings ignorando mayúsculas/minúsculas (patrón de Palabra.php)
// Uso: if (compararTexto($respuesta, $_SESSION["palabraActual"]["palabra"])) { ... }
function compararTexto($a, $b) {
    return strtolower(trim($a)) === strtolower(trim($b));
}


// ─────────────────────────────────────────────
// MANEJO DE ACCIONES
// ─────────────────────────────────────────────

// Despacha la acción POST a la función correspondiente
// Evita repetir el bloque if/elseif en cada script (patrón de todos los ajax)
//
// Uso:
//   manejarAccion([
//       "nueva"      => function() use ($objeto) { echo $objeto->setearPalabra(); },
//       "pista"      => function() use ($objeto) { echo $objeto->obtenerPista(); },
//       "arriesgar"  => function() use ($objeto) { echo $objeto->verificar(postParam("palabraIngresada")); },
//       "abandonar"  => function() use ($objeto) { $objeto->abandonar(); }
//   ]);
function manejarAccion($mapaAcciones) {
    $accion = postParam("accion");
    if ($accion === null) {
        respuestaError("No se especificó una acción");
        return;
    }
    if (!isset($mapaAcciones[$accion])) {
        respuestaError("Acción desconocida: $accion");
        return;
    }
    ($mapaAcciones[$accion])();
}
