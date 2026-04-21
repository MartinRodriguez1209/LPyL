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
  localStorage.setItem("puntajeTotal", resultado);
  window.location.href = "resultado.html";
}
