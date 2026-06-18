// ============================================================
// UTILS JS AJAX
// Funciones genéricas para el manejo de AJAX en el cliente
// Extraídas de patrones repetidos en: script.js (aviones, palabra, productos)
// y ciudades (index.html inline)
// ============================================================


// ─────────────────────────────────────────────
// PETICIONES AJAX
// ─────────────────────────────────────────────

// Hace un GET y ejecuta el callback con los datos ya parseados como objeto
// Uso: ajaxGet("ciudades.php?pais=" + pais, function(datos) { ... })
// Uso: ajaxGet("aviones.php?nombreReducido=" + busqueda, function(datos) { ... })
function ajaxGet(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var datos = JSON.parse(xhr.responseText);
            callback(datos);
        }
    };
    xhr.open("GET", url, true);
    xhr.send(null);
}

// Hace un POST y ejecuta el callback con los datos ya parseados como objeto
// Uso: ajaxPost("palabra.php", "accion=nueva", function(datos) { ... })
// Uso: ajaxPost("productos_ajax.php", "accion=obtenerProductos", function(datos) { ... })
function ajaxPost(url, params, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var datos = JSON.parse(xhr.responseText);
            callback(datos);
        }
    };
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
}

// Arma el string de parámetros para GET o POST a partir de un objeto
// Uso: buildParams({ accion: "nueva", nombre: "Juan" }) → "accion=nueva&nombre=Juan"
// Uso: buildParams({ accion: "arriesgar", palabraIngresada: inputPalabra }) → "accion=arriesgar&palabraIngresada=..."
function buildParams(objeto) {
    return Object.keys(objeto)
        .map(key => encodeURIComponent(key) + "=" + encodeURIComponent(objeto[key]))
        .join("&");
}

// Arma la URL completa con parámetros GET a partir de un objeto
// Uso: buildUrl("ciudades.php", { pais: "Argentina" }) → "ciudades.php?pais=Argentina"
// Uso: buildUrl("aviones.php", { nombreReducido: busqueda }) → "aviones.php?nombreReducido=B737"
function buildUrl(url, params) {
    return url + "?" + buildParams(params);
}


// ─────────────────────────────────────────────
// ACCESO AL DOM
// ─────────────────────────────────────────────

// Atajo para document.getElementById — usado constantemente en todos los scripts
// Uso: getId("tablaAviones").innerHTML = ""
// Uso: getId("inputPalabra").value
function getId(id) {
    return document.getElementById(id);
}

// Devuelve el value de un input/select
// Uso: var busqueda = getValor("nombreReducido")
// Uso: var pais = getValor("pais")
function getValor(id) {
    return document.getElementById(id).value;
}

// Devuelve el value de un input como número entero
// Uso: var codigo = getInt("idSeleccionProducto")
function getInt(id) {
    return parseInt(document.getElementById(id).value);
}


// ─────────────────────────────────────────────
// MODIFICAR CONTENIDO
// ─────────────────────────────────────────────

// Escribe texto plano en un elemento
// Uso: setText("cantLetras", datos.cantLetras)
// Uso: setText("puntaje", 80)
function setText(id, texto) {
    document.getElementById(id).innerText = texto;
}

// Escribe HTML en un elemento (reemplaza todo el contenido)
// Uso: setHtml("ciudades", "<ul><li>Buenos Aires</li></ul>")
function setHtml(id, html) {
    document.getElementById(id).innerHTML = html;
}

// Limpia el contenido HTML de un elemento (equivale a setHtml con "")
// Uso: limpiar("tablaAviones")
// Uso: limpiar("idZonaPistas")
function limpiar(id) {
    document.getElementById(id).innerHTML = "";
}


// ─────────────────────────────────────────────
// MOSTRAR Y OCULTAR
// ─────────────────────────────────────────────

// Muestra un elemento (display block)
// Uso: mostrar("idZonaControles")
function mostrar(id) {
    document.getElementById(id).style.display = "block";
}

// Oculta un elemento (display none)
// Uso: ocultar("idZonaResultado")
function ocultar(id) {
    document.getElementById(id).style.display = "none";
}

// Muestra varios elementos a la vez (patrón de victoria/fallo en palabra)
// Uso: mostrarVarios(["idZonaAyuda", "idZonaPistas", "idZonaControles"])
function mostrarVarios(ids) {
    ids.forEach(id => mostrar(id));
}

// Oculta varios elementos a la vez (patrón de victoria/fallo en palabra)
// Uso: ocultarVarios(["idZonaAyuda", "idZonaPistas", "idZonaControles"])
function ocultarVarios(ids) {
    ids.forEach(id => ocultar(id));
}


// ─────────────────────────────────────────────
// CREAR Y AGREGAR ELEMENTOS
// ─────────────────────────────────────────────

// Crea un elemento HTML con texto y lo agrega a un padre
// Uso: agregarElemento("idZonaPistas", "h3", "Es un animal")
// Uso: agregarElemento("idZonaResultado", "h3", "GANASTE!")
function agregarElemento(idPadre, tipo, texto) {
    var elemento = document.createElement(tipo);
    elemento.innerText = texto;
    document.getElementById(idPadre).appendChild(elemento);
    return elemento;
}

// Crea un <tr> con los valores de un array como <td> y lo agrega a un tbody
// Uso: agregarFila("tablaAviones", [avion.matricula, avion.fechaIngreso, avion.capacidad])
function agregarFila(idTbody, valores) {
    var row = document.createElement("tr");
    valores.forEach(valor => {
        var td = document.createElement("td");
        td.innerText = valor;
        row.appendChild(td);
    });
    document.getElementById(idTbody).appendChild(row);
    return row;
}

// Crea un <tr> con las claves de un objeto como <td> y lo agrega a un tbody
// Uso: agregarFilaObjeto("idTablaBody", { sucursal: "Centro", cantidad: 10 })
// Útil para tablas de stock por sucursal (productos)
function agregarFilaObjeto(idTbody, objeto) {
    return agregarFila(idTbody, Object.values(objeto));
}

// Crea un <option> y lo agrega a un <select>
// Uso: agregarOpcion("idSeleccionProducto", producto.codigoProducto, producto.nombreProducto)
function agregarOpcion(idSelect, valor, texto) {
    var option = document.createElement("option");
    option.value = valor;
    option.innerText = texto;
    document.getElementById(idSelect).appendChild(option);
}

// Llena un contenedor con una lista <ul><li> a partir de un array de strings
// Uso: llenarLista("ciudades", ["Buenos Aires", "Trelew", "Comodoro"])
function llenarLista(id, array) {
    var html = "<ul>";
    array.forEach(item => { html += "<li>" + item + "</li>"; });
    html += "</ul>";
    document.getElementById(id).innerHTML = html;
}


// ─────────────────────────────────────────────
// EVENTOS
// ─────────────────────────────────────────────

// Agrega un listener de click a un elemento
// Uso: alClick("btnNuevaPartida", nuevaPartida)
// Uso: alClick("btnArriesgar", arriesgar)
function alClick(id, fn) {
    document.getElementById(id).addEventListener("click", fn);
}

// Agrega un listener de change a un elemento (select, input)
// Uso: alChange("idSeleccionProducto", detalleProducto)
// Uso: alChange("pais", buscarCiudades)
function alChange(id, fn) {
    document.getElementById(id).addEventListener("change", fn);
}


// ─────────────────────────────────────────────
// ARRAYS Y DATOS
// ─────────────────────────────────────────────

// Busca un elemento en un array por el valor de una propiedad
// Uso: var producto = buscarEn(productos, "codigoProducto", codigoElegido)
function buscarEn(array, clave, valor) {
    return array.find(item => item[clave] === valor);
}
