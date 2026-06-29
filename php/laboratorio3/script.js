document
  .getElementById("idFabricante")
  .addEventListener("change", getAvionesFabricante);
document.getElementById("idBase").addEventListener("change", getAvionesBase);

var fabricanteSeleccionado = "";
var baseSeleccionada = "";

function getAvionesFabricante() {
  console.log(document.getElementById("idFabricante").value);
  fabricanteSeleccionado = document.getElementById("idFabricante").value;

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var respuesta = JSON.parse(xhr.responseText);
      mostrarInfo(respuesta);
    }
  };
  xhr.open("POST", "Avion.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  if (baseSeleccionada == "")
    xhr.send(
      "accion=getAvionesFabricante&fabricante=" + fabricanteSeleccionado,
    );
  else
    xhr.send(
      "accion=getAvionesFabricante&fabricante=" +
        fabricanteSeleccionado +
        "&base=" +
        baseSeleccionada,
    );
}
function getAvionesBase() {
  baseSeleccionada = document.getElementById("idBase").value;

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var respuesta = JSON.parse(xhr.responseText);
      mostrarInfo(respuesta);
    }
  };
  xhr.open("POST", "Avion.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  if (fabricanteSeleccionado == "")
    xhr.send("accion=getAvionesFabricante&base=" + baseSeleccionada);
  else {
    xhr.send(
      "accion=getAvionesFabricante&fabricante=" +
        fabricanteSeleccionado +
        "&base=" +
        baseSeleccionada,
    );
  }
}

function cargarFabricantes() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var respuesta = JSON.parse(xhr.responseText);
      var selector = document.getElementById("idFabricante");
      respuesta.forEach((avion) => {
        var op = document.createElement("option");
        op.text = avion;
        selector.appendChild(op);
      });
    }
  };
  xhr.open("POST", "Avion.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=getFabricantes");
}

function cargarBases() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var respuesta = JSON.parse(xhr.responseText);
      var selector = document.getElementById("idBase");
      respuesta.forEach((base) => {
        var op = document.createElement("option");
        op.text = base;
        selector.appendChild(op);
      });
    }
  };
  xhr.open("POST", "Avion.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=getBases");
}

function mostrarInfo(listadoAviones) {
  console.log(listadoAviones);
  var contInfo = document.getElementById("idContInfo");
  contInfo.innerText = "Listado de aviones";
  listadoAviones.forEach((avion) => {
    var span = document.createElement("span");
    var infoAvion =
      " Matricula= " +
      avion.matriculaAvion +
      " Empresa= " +
      avion.nombreEmpresa;
    var infoTag = document.createElement("p");
    infoTag.innerText = infoAvion;
    span.append(infoTag);
    var boton = document.createElement("button");
    boton.value = avion.idAvion;
    boton.addEventListener("click", () => abrirModal(avion.idAvion));
    boton.innerText = "Mas info";
    span.append(boton);
    contInfo.appendChild(span);
  });
  document.getElementById("idCantidad").innerText =
    "Cantidad de resultados= " + listadoAviones.length;
}

function abrirModal(idAvion) {
  var info = document.getElementById("idInfoAvion");
  info.innerText = "";
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var avion = JSON.parse(xhr.responseText);
      console.log(avion);

      var infoAvion = document.createElement("h3");
      var infoEmpresa = document.createElement("h3");
      infoAvion.innerText =
        "Fabricante= " +
        avion.fabricanteAvion +
        " Modelo=" +
        avion.modeloAvion +
        "Matricula = " +
        avion.matriculaAvion +
        " \nCantidad filas asientos= " +
        avion.asientosFilaAvion +
        " Capacidad total=" +
        avion.asientosFilaAvion * avion.filasAvion;
      infoEmpresa.innerText =
        "Empresa=" +
        avion.nombreEmpresa +
        " Aeropuerto =" +
        avion.baseAvion +
        " Primer vuelo= " +
        avion.primerVuelo;
      info.append(infoAvion);
      info.append(infoEmpresa);
    }
  };
  xhr.open("POST", "Avion.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=getInfoAvion&idAvion=" + idAvion);

  document.getElementById("idModal").showModal();
}

cargarFabricantes();
cargarBases();
