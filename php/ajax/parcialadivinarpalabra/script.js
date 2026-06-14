document
  .getElementById("btnNuevaPartida")
  .addEventListener("click", nuevaPartida);
document.getElementById("btnArriesgar").addEventListener("click", arriesgar);
document.getElementById("btnPista").addEventListener("click", pista);
document.getElementById("btnAbandonar").addEventListener("click", abandonar);

var puntajeInicial = 80;
var pistasSolicitadas = 0;

function nuevaPartida() {
  pistasSolicitadas = 0;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var datos = JSON.parse(xhr.responseText);

      document.getElementById("cantLetras").innerText = datos.cantLetras;
      document.getElementById("dificultad").innerText = datos.dificultad;
      document.getElementById("vecesAdivinada").innerText =
        datos.vecesAdivinada;
      document.getElementById("puntaje").innerText = puntajeInicial;

      document.getElementById("idZonaPistas").innerHTML = "";
      document.getElementById("idZonaResultado").style.display = "none";
      document.getElementById("idZonaResultado").innerHTML = "";
      document.getElementById("idZonaAyuda").style.display = "block";
      document.getElementById("idZonaPistas").style.display = "block";
      document.getElementById("idZonaControles").style.display = "block";
    }
  };
  xhr.open("POST", "palabra.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=nueva");
}

function arriesgar() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var respuesta = JSON.parse(xhr.responseText);
      if (respuesta) victoria();
      else fallo();
    }
  };
  xhr.open("POST", "palabra.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(
    "accion=arriesgar&palabraIngresada=" +
      document.getElementById("inputPalabra").value,
  );
}

function pista() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var pista = JSON.parse(xhr.responseText).pista;
      var pistaTag = document.createElement("h3");
      pistaTag.innerText = pista;
      document.getElementById("idZonaPistas").appendChild(pistaTag);
      pistasSolicitadas++;
    }
  };
  xhr.open("POST", "palabra.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=pista");
}

function victoria() {
  document.getElementById("idZonaResultado").style.display = "block";

  document.getElementById("idZonaAyuda").style.display = "none";
  document.getElementById("idZonaPistas").style.display = "none";
  document.getElementById("idZonaControles").style.display = "none";
  var victoriaMensaje = document.createElement("h3");
  victoriaMensaje.innerText =
    "GANASTE, TU PUNTAJE ES DE:" +
    (pistasSolicitadas == 0 ? 100 : puntajeInicial - pistasSolicitadas * 15);
  document.getElementById("idZonaResultado").appendChild(victoriaMensaje);
}
function fallo() {
  document.getElementById("idZonaResultado").style.display = "block";

  document.getElementById("idZonaAyuda").style.display = "none";
  document.getElementById("idZonaPistas").style.display = "none";
  document.getElementById("idZonaControles").style.display = "none";
  var derrotaMensaje = document.createElement("h3");
  derrotaMensaje.innerText = "Perdiste!!!";
  document.getElementById("idZonaResultado").appendChild(derrotaMensaje);
}

function abandonar() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("idZonaAyuda").style.display = "none";
      document.getElementById("idZonaPistas").style.display = "none";
      document.getElementById("idZonaControles").style.display = "none";
      pistasSolicitadas = 0;
    }
  };
  xhr.open("POST", "palabra.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=abandonar");
}
