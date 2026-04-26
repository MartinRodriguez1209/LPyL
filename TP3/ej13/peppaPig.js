const USUARIO = JSON.parse(sessionStorage.getItem("usuarioActual"));
console.log(USUARIO);

document.getElementById("idNombreTitulo").textContent = USUARIO.nombre;

document.getElementById("idNumeroVisita").textContent = USUARIO.numeroVisita;

document.getElementById("idFechaVisita").textContent = USUARIO.ultimaVisita;

document
  .getElementById("idBotonAgregarUtil")
  .addEventListener("click", agregarItem);

function agregarItem() {
  const inputUtil = document.getElementById("idInputUtil");
  const utilNuevo = inputUtil.value;
  USUARIO.listaUtiles.push(utilNuevo);
  sessionStorage.setItem("usuarioActual", JSON.stringify(USUARIO));
  localStorage.setItem(USUARIO.nombreUsuario, JSON.stringify(USUARIO));
  cargarLista();
}

document
  .getElementById("idBorrarUtiles")
  .addEventListener("click", limpiarLista);

function limpiarLista() {
  USUARIO.listaUtiles = [];
  sessionStorage.setItem("usuarioActual", JSON.stringify(USUARIO));
  localStorage.setItem(USUARIO.nombreUsuario, JSON.stringify(USUARIO));
  cargarLista();
}

function cargarLista() {
  const listaUtiles = document.getElementById("idListaUtiles");
  listaUtiles.innerHTML = "";

  if (USUARIO.listaUtiles.length === 0) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "NO HAY UTILES ACTUALMENTE";
    listaUtiles.appendChild(mensaje);
  } else {
    USUARIO.listaUtiles.forEach((element) => {
      const util = document.createElement("li");
      util.textContent = element;
      listaUtiles.appendChild(util);
    });
  }
}

cargarLista();
