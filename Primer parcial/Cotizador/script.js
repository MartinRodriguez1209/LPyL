const campos = {
  acuario: `
    <span><label>Alto (cm): <input type="number" name="alto" /></label></span>
    <span><label>Ancho (cm): <input type="number" name="ancho" /></label></span>
    <span><label>Cantidad de peces: <input type="number" name="peces" /></label></span>
        <select name="sucursalRetiro" id="idSucursalEntrega">
        <option value="" disabled selected hidden>Sucursal de entrega</option>
        <option value="central">Veterinaria central</option>
        <option value="pueyrredon">Sucursal Pueyrredón</option>
        <option value="km8">Sucursal Km 8</option>
        <option value="caleta">Sucursal Caleta Córdoba</option>
        <option value="radaTilly">Sucursal Rada Tilly</option>
      </select>
             <select name="sucursalRetiro" id="idSucursalRetiro">
        <option value="" disabled selected hidden>Sucursal de retiro</option>
        <option value="central">Veterinaria central</option>
        <option value="pueyrredon">Sucursal Pueyrredón</option>
        <option value="km8">Sucursal Km 8</option>
        <option value="caleta">Sucursal Caleta Córdoba</option>
        <option value="radaTilly">Sucursal Rada Tilly</option>
      </select>
       <span><label>Domicilio del acuario <input type="text" name="domicilio" /></label></span>
    <button type="button" onclick="calcular()">Calcular</button>

  `,
  peluqueria: camposAnimal(),
  banio: camposAnimal(),
  vacunacion: camposAnimal(),
  consulta: camposAnimal(),
};
function camposAnimal() {
  return `
    <span><label>Cantidad de animales: <input type="number" name="cantidad" /></label> </span>
    <span> <label>Raza: <input type="text" name="raza" /></label></span>
    <span> <label>Peso aproximado (kg): <input type="number" name="peso" /></label></span>
    <span><label><input type="checkbox" name="agresivo" /> ¿Es agresivo?</label></span>
    <span><label><input type="checkbox" name="esCliente" /> ¿Es cliente de la veterinaria?</label></span>
    <span><label>Observaciones: <input type="text" name="observaciones" /></label></span>
    <span><label>Observaciones: <input type="text" name="observaciones" /></label></span>
     
            <select name="sucursalRetiro" id="idSucursalEntrega">
        <option value="" disabled selected hidden>Sucursal de entrega</option>
        <option value="central">Veterinaria central</option>
        <option value="pueyrredon">Sucursal Pueyrredón</option>
        <option value="km8">Sucursal Km 8</option>
        <option value="caleta">Sucursal Caleta Córdoba</option>
        <option value="radaTilly">Sucursal Rada Tilly</option>
      </select>
             <select name="sucursalRetiro" id="idSucursalRetiro">
        <option value="" disabled selected hidden>Sucursal de retiro</option>
        <option value="central">Veterinaria central</option>
        <option value="pueyrredon">Sucursal Pueyrredón</option>
        <option value="km8">Sucursal Km 8</option>
        <option value="caleta">Sucursal Caleta Córdoba</option>
        <option value="radaTilly">Sucursal Rada Tilly</option>
      </select>
      <button type="button" onclick="calcular()">Calcular</button>
  `;
}
document
  .getElementById("idServicioElegido")
  .addEventListener("change", function () {
    const contenedor = document.getElementById("camposDinamicos");
    contenedor.innerHTML = campos[this.value] || "";
    document.getElementById("mensajeResultado").innerHTML = "";
  });

function calcular() {
  const servicioelegido = document.getElementById("idServicioElegido").value;
  const form = document.getElementById("idFormularioCotizacion");
  const datos = new FormData(form);
  let costoTotal;
  const cantidad = Number(datos.get("cantidad"));
  const peso = Number(datos.get("peso"));
  const alto = Number(datos.get("alto"));
  const ancho = Number(datos.get("ancho"));
  switch (servicioelegido) {
    case "acuario":
      costoTotal = 125 * (alto / 100) * (ancho / 100);
      break;
    case "consulta":
      costoTotal = 180 * cantidad;
      break;
    case "banio":
      if (datos.get("peso") <= 35) {
        costoTotal = 250 * cantidad;
      } else {
        costoTotal = (250 + (peso - 35) * 15) * cantidad;
      }
      break;
    case "peluqueria":
      if (datos.get("peso") <= 25) {
        costoTotal = 300 * cantidad;
      } else {
        costoTotal = (250 + (datos.get(peso) - 25) * 28) * cantidad;
      }
      break;
    case "vacunacion":
      costoTotal = (150 + 55) * cantidad;
      break;
    default:
      break;
  }
  document.getElementById("mensajeResultado").innerHTML =
    `<h2>El costo total es de: $${costoTotal}</h2>`;
}
