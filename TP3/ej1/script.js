let arreglo = new Array();

generarNumerosRandom();
cantidadYSuma();
menorYMayor();
primerYUltimoNumero();
numeroCinco();
promedio();
arregloMenorMayor();

function generarNumerosRandom() {
  let h2 = document.getElementById("idArregloAleatorio");
  for (let index = 0; index < 10; index++) {
    var rnd = Math.floor(Math.random() * (20 - 0 + 1)) + 0;
    arreglo.push(rnd);
    h2.append(rnd + " ");
  }
}

function cantidadYSuma() {
  console.log(arreglo.length);

  document.getElementById("idCantidadNumeros").append(arreglo.length);
  document
    .getElementById("idSumaNumeros")
    .append(
      arreglo.reduce((acumulador, valorActual) => acumulador + valorActual, 0),
    );
}

function menorYMayor() {
  document.getElementById("idMayorNumero").append(Math.max(...arreglo));
  document.getElementById("idMenorNumero").append(Math.min(...arreglo));
}

function primerYUltimoNumero() {
  document.getElementById("idPrimerElemento").append(arreglo[0]);
  document
    .getElementById("idUltimoElemento")
    .append(arreglo[arreglo.length - 1]);
}

function numeroCinco() {
  let estaElNumero = arreglo.find((numero) => numero === 5)
    ? "El numero 5 SI esta"
    : "El numero 5 NO esta";
  document.getElementById("idNumero5").append(estaElNumero);
}

function promedio() {
  const tag = document.createElement("h2");
  tag.textContent =
    "El promedio es " +
    arreglo.reduce((sum, valor) => sum + valor) / arreglo.length;
  document.body.appendChild(tag);
}

function arregloMenorMayor() {
  arreglo.sort((a, b) => a - b);
  const tag = document.createElement("h2");
  tag.textContent = "Arreglo ordenado de menor a mayor: " + arreglo;
  document.body.appendChild(tag);
}
