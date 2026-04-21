const puntajeTotal = localStorage.getItem("puntajeTotal");
const span = document.getElementById("idPuntajeFinal");
span.textContent = puntajeTotal;

let mensaje = "";

if (puntajeTotal < 6) {
  mensaje = "DESAPROBADO";
} else if (puntajeTotal >= 6 && puntajeTotal < 8) {
  mensaje = "APROBADO PARA AYUDANTE";
} else {
  mensaje = "APROBADO PARA COCINERO";
}
const mensajeResultado = document.getElementById("idMensajeResultado");
mensajeResultado.textContent = mensaje;
