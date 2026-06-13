<?php
// ============================================================
// UTILS PHP AJAX
// Funciones genéricas para el manejo de AJAX en el servidor
// ============================================================

// Devuelve el valor de un parámetro GET o un default si no existe
// Ejemplo: getParam("nombreReducido") → "B737"
function getParam($nombre, $default = null) {
    return isset($_GET[$nombre]) ? $_GET[$nombre] : $default;
}

// Devuelve el valor de un parámetro POST o un default si no existe
// Ejemplo: postParam("accion") → "nueva"
function postParam($nombre, $default = null) {
    return isset($_POST[$nombre]) ? $_POST[$nombre] : $default;
}

// Devuelve una respuesta JSON de éxito con datos opcionales
// Ejemplo: respuestaOk(array("nombre" => "Juan")) → {"ok":true,"datos":{"nombre":"Juan"}}
function respuestaOk($datos = null) {
    echo json_encode(array(
        "ok"   => true,
        "datos" => $datos
    ));
}

// Devuelve una respuesta JSON de error con un mensaje
// Ejemplo: respuestaError("Cliente no encontrado") → {"ok":false,"error":"Cliente no encontrado"}
function respuestaError($mensaje) {
    echo json_encode(array(
        "ok"    => false,
        "error" => $mensaje
    ));
}

// Conecta a la base de datos y devuelve la conexión
// Si falla, responde con un JSON de error y termina la ejecución
function conectar($host, $usuario, $password, $base) {
    $conexion = new mysqli($host, $usuario, $password, $base);
    if ($conexion->connect_error) {
        respuestaError("Error de conexión: " . $conexion->connect_error);
        exit;
    }
    return $conexion;
}

// Ejecuta una consulta preparada y devuelve todos los resultados como array
// Ejemplo: fetchTodos($conexion, "SELECT * FROM clientes WHERE ciudad = ?", "s", ["Comodoro"])
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
// Ejemplo: fetchUno($conexion, "SELECT * FROM clientes WHERE documento = ?", "s", ["12345678"])
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

// Ejecuta una consulta de acción (INSERT, UPDATE, DELETE)
// Devuelve true si tuvo éxito, false si no
// Ejemplo: ejecutar($conexion, "UPDATE palabras SET acertada = acertada + 1 WHERE idPalabra = ?", "i", [3])
function ejecutar($conexion, $sql, $tipos = null, $params = null) {
    $stmt = $conexion->prepare($sql);
    if ($tipos && $params) {
        $stmt->bind_param($tipos, ...$params);
    }
    return $stmt->execute();
}
