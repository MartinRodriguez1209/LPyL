// ============================================================
// UTILS JS AJAX
// Funciones genéricas para el manejo de AJAX en el cliente
// ============================================================

// Hace un GET y ejecuta el callback con los datos parseados
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

// Hace un POST y ejecuta el callback con los datos parseados
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

// Arma un string de parámetros para GET o POST a partir de un objeto
// Ejemplo: buildParams({accion: "nueva", nombre: "Juan"}) → "accion=nueva&nombre=Juan"
function buildParams(objeto) {
    return Object.keys(objeto)
        .map((key) => encodeURIComponent(key) + "=" + encodeURIComponent(objeto[key]))
        .join("&");
}

// ============================================================
// Manejo del DOM
// ============================================================

// Escribe texto en un elemento
function setText(id, texto) {
    document.getElementById(id).innerText = texto;
}

// Limpia el contenido de un elemento
function limpiar(id) {
    document.getElementById(id).innerHTML = "";
}

// Muestra un elemento (display block)
function mostrar(id) {
    document.getElementById(id).style.display = "block";
}

// Oculta un elemento (display none)
function ocultar(id) {
    document.getElementById(id).style.display = "none";
}

// Crea un elemento con texto y lo agrega a un padre
// Ejemplo: agregarElemento("idZonaPistas", "p", "Es un animal")
function agregarElemento(idPadre, tipo, texto) {
    var elemento = document.createElement(tipo);
    elemento.innerText = texto;
    document.getElementById(idPadre).appendChild(elemento);
    return elemento;
}

// Crea un <tr> con los valores de un array como <td> y lo agrega a un tbody
// Ejemplo: agregarFila("tablaAviones", ["LV-BYY", "13/05/2009", "138", "12C+126Y"])
function agregarFila(idTbody, valores) {
    var row = document.createElement("tr");
    valores.forEach((valor) => {
        var td = document.createElement("td");
        td.innerText = valor;
        row.appendChild(td);
    });
    document.getElementById(idTbody).appendChild(row);
    return row;
}
