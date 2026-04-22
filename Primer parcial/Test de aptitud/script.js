const formularioDatosUsuario = document.getElementById(
  "idFormularioDatosUsuario",
);
const formulario = document.getElementById("idFormulario");

formularioDatosUsuario.addEventListener("submit", function (evento) {
  evento.preventDefault();
  formulario.style.visibility = "visible";
});

formulario.addEventListener("submit", function (evento) {
  evento.preventDefault();
  let totalAcumulado = 0;

  const respuestas = formulario.querySelectorAll("input:checked");

  respuestas.forEach(function (input) {
    let puntos = parseInt(input.value, 10);
    let porcentaje = parseFloat(input.dataset.porcentaje, 10);
    totalAcumulado += puntos * porcentaje;
  });
  mostrarResultado(totalAcumulado);
});

function mostrarResultado(resultado) {
  sessionStorage.setItem("puntajeTotal", resultado);
  const nombre = document.getElementById("idNombre").value;
  const apellido = document.getElementById("idApellido").value;
  const edad = document.getElementById("idEdad").value;

  const mail =
    "Datos del postulante: " +
    nombre +
    " " +
    " " +
    apellido +
    "\nEdad:" +
    edad +
    "\n Resultado del test: " +
    resultado;
  window.location.href =
    "mailto:" +
    "postulantes@empresacocina.com.ar" +
    "?subject=" +
    encodeURIComponent("TEST DE APTITUD") +
    "&body=" +
    encodeURIComponent(mail);
  window.location.href = "resultado.html";
}
