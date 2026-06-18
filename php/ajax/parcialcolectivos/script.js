// ============================================================
// main.js
// Lógica del lado del cliente para la consulta de servicios
// de larga distancia. Se comunica con los scripts PHP del
// servidor mediante fetch() e intercambia datos en JSON.
// ============================================================

// --- Referencias a elementos del DOM ---
const selectorEmpresa = document.getElementById("selectorEmpresa");
const selectorDia = document.getElementById("selectorDia");
const cuerpoTablaServicios = document.getElementById("cuerpoTablaServicios");
const totalServiciosSpan = document.getElementById("totalServicios");
const mensajeSinResultados = document.getElementById("mensajeSinResultados");

const overlayModal = document.getElementById("overlayModal");
const modal = overlayModal.querySelector(".modal");
const btnAceptarModal = document.getElementById("btnAceptarModal");

const modalDiasOpera = document.getElementById("modalDiasOpera");
const modalAsientosSemicama = document.getElementById("modalAsientosSemicama");
const modalPrecioSemicama = document.getElementById("modalPrecioSemicama");
const modalAsientosCama = document.getElementById("modalAsientosCama");
const modalPrecioCama = document.getElementById("modalPrecioCama");
const modalWebEmpresa = document.getElementById("modalWebEmpresa");

const main = document.querySelector("main.contenedor");

// Caché en memoria de los servicios devueltos por el último
// pedido al servidor. Se usa para mostrar el detalle en la
// ventana emergente sin tener que hacer un segundo pedido.
let serviciosCache = {};

// Guarda qué elemento tenía el foco antes de abrir el modal,
// para devolvérselo cuando se cierra (requisito 4 del enunciado).
let ultimoElementoConFoco = null;

// Soporte del atributo "inert" (no todos los navegadores lo
// implementan, así que lo usamos solo si está disponible).
const soportaInert = "inert" in HTMLElement.prototype;

// ============================================================
// 1) Carga inicial: empresas desde la base de datos
// ============================================================

async function cargarEmpresas() {
  try {
    const respuesta = await fetch("php/api.php?accion=empresas");
    const empresas = await respuesta.json();

    empresas.forEach((empresa) => {
      const opcion = document.createElement("option");
      opcion.value = empresa.idEmpresa;
      opcion.textContent = empresa.nombreEmpresa;
      selectorEmpresa.appendChild(opcion);
    });
  } catch (error) {
    console.error("No se pudieron cargar las empresas:", error);
  }
}

// ============================================================
// 2) Búsqueda de servicios según los filtros seleccionados
// ============================================================

async function buscarServicios() {
  const parametros = new URLSearchParams();
  parametros.set("accion", "buscar");

  if (selectorEmpresa.value) {
    parametros.set("idEmpresa", selectorEmpresa.value);
  }
  if (selectorDia.value) {
    parametros.set("dia", selectorDia.value);
  }

  try {
    const respuesta = await fetch(`php/api.php?${parametros.toString()}`);
    const servicios = await respuesta.json();
    renderizarServicios(servicios);
  } catch (error) {
    console.error("Error al buscar servicios:", error);
  }
}

function renderizarServicios(servicios) {
  cuerpoTablaServicios.innerHTML = "";
  serviciosCache = {};

  servicios.forEach((servicio) => {
    serviciosCache[servicio.idServicio] = servicio;

    const fila = document.createElement("tr");
    fila.innerHTML = `
      <td>${servicio.idServicio}</td>
      <td>${servicio.ciudadOrigen}</td>
      <td>${servicio.ciudadDestino}</td>
      <td>${servicio.horaSalida}</td>
      <td>${servicio.horaLlegada}</td>
      <td><button type="button" class="boton-info" data-id="${servicio.idServicio}">+ info</button></td>
    `;
    cuerpoTablaServicios.appendChild(fila);
  });

  totalServiciosSpan.textContent = servicios.length;
  mensajeSinResultados.hidden = servicios.length !== 0;
}

// Delegación de eventos: un solo listener para todos los
// botones "+ info", aunque las filas se generen dinámicamente.
cuerpoTablaServicios.addEventListener("click", (evento) => {
  const boton = evento.target.closest(".boton-info");
  if (!boton) return;

  abrirModal(boton.dataset.id, boton);
});

selectorEmpresa.addEventListener("change", buscarServicios);
selectorDia.addEventListener("change", buscarServicios);

// ============================================================
// 3) Ventana emergente (modal) y manejo del foco
// ============================================================
//
// Requisito del enunciado: "Cuando el usuario pulse el botón de
// mayor información no debe poder realizar ninguna otra
// operación en la página".
//
// Esto implica dos cosas distintas, y hay que cubrir ambas:
//
//   a) Bloquear el MOUSE: el overlay (#overlayModal) es un div
//      a pantalla completa con z-index alto que tapa el resto
//      de la página, así que cualquier click "afuera" del modal
//      en realidad cae sobre el overlay, no sobre los controles
//      de atrás. Eso ya lo resuelve el CSS.
//
//   b) Bloquear el TECLADO: esto es lo que normalmente se pasa
//      por alto. Si no hacés nada, el usuario puede seguir
//      apretando Tab y el foco se va a ir paseando por los
//      selects y filas de la tabla que están "debajo" del modal,
//      aunque visualmente estén tapados. Para esto:
//
//      - Al abrir el modal, le sacamos el foco a lo que sea que
//        lo tenía y lo mandamos adentro del modal.
//      - Marcamos el contenido principal (<main>) como inert
//        (o aria-hidden si el navegador no soporta inert), para
//        que ni el teclado ni los lectores de pantalla puedan
//        interactuar con él mientras el modal está abierto.
//      - Mientras el modal esté abierto, interceptamos la tecla
//        Tab para que el foco quede "atrapado" dando vueltas
//        solo entre los elementos del modal (esto se llama
//        "focus trap").
//      - Al cerrar el modal, devolvemos el foco al botón "+ info"
//        que lo abrió (así el usuario retoma la búsqueda justo
//        donde la dejó, como pide el punto 4 del enunciado) y
//        quitamos el inert/aria-hidden del contenido principal.

function obtenerFocosablesDelModal() {
  const selector =
    'a[href], button, select, textarea, input, [tabindex]:not([tabindex="-1"])';
  return Array.from(modal.querySelectorAll(selector)).filter(
    (el) => !el.disabled && el.offsetParent !== null,
  );
}

function abrirModal(idServicio, elementoQueDisparo) {
  const servicio = serviciosCache[idServicio];
  if (!servicio) return;

  // Completar los datos del detalle
  modalDiasOpera.textContent = servicio.diasOpera.join(", ");
  modalAsientosSemicama.textContent = servicio.asientosSemicama;
  modalPrecioSemicama.textContent = `$${servicio.precioPasajeSemicama}`;
  modalAsientosCama.textContent = servicio.asientosCama;
  modalPrecioCama.textContent = `$${servicio.precioPasajeCama}`;
  modalWebEmpresa.href = servicio.webEmpresa;
  modalWebEmpresa.textContent = servicio.webEmpresa;

  // Guardar el foco actual para restaurarlo al cerrar
  ultimoElementoConFoco = elementoQueDisparo || document.activeElement;

  // Anular el contenido principal mientras el modal está abierto
  if (soportaInert) {
    main.inert = true;
  } else {
    main.setAttribute("aria-hidden", "true");
  }

  overlayModal.hidden = false;

  // Mover el foco adentro del modal (al primer elemento focoseable)
  const focosables = obtenerFocosablesDelModal();
  if (focosables.length > 0) {
    focosables[0].focus();
  }

  document.addEventListener("keydown", manejarTeclaModal);
}

function cerrarModal() {
  overlayModal.hidden = true;

  if (soportaInert) {
    main.inert = false;
  } else {
    main.removeAttribute("aria-hidden");
  }

  document.removeEventListener("keydown", manejarTeclaModal);

  // Devolver el control (y el foco) a la página de resultados
  if (ultimoElementoConFoco) {
    ultimoElementoConFoco.focus();
  }
  ultimoElementoConFoco = null;
}

function manejarTeclaModal(evento) {
  if (evento.key === "Escape") {
    cerrarModal();
    return;
  }

  if (evento.key !== "Tab") return;

  // --- Focus trap: hace que Tab / Shift+Tab den vueltas
  //     solamente entre los elementos del modal ---
  const focosables = obtenerFocosablesDelModal();
  if (focosables.length === 0) return;

  const primero = focosables[0];
  const ultimo = focosables[focosables.length - 1];

  if (evento.shiftKey && document.activeElement === primero) {
    evento.preventDefault();
    ultimo.focus();
  } else if (!evento.shiftKey && document.activeElement === ultimo) {
    evento.preventDefault();
    primero.focus();
  }
}

btnAceptarModal.addEventListener("click", cerrarModal);

// ============================================================
// Inicialización
// ============================================================

document.addEventListener("DOMContentLoaded", () => {
  cargarEmpresas();
  buscarServicios(); // muestra el listado completo al entrar
});
