document
  .getElementById("idCrearUsuario")
  .addEventListener("click", crearUsuario);

function crearUsuario() {
  const form = document.getElementById("idFormCrearUsuario");
  const datosUsuario = new FormData(form);
  const nombreUsuario = datosUsuario.get("nombreUsuario");

  const usuario = {
    nombre: datosUsuario.get("nombre"),
    apellido: datosUsuario.get("apellido"),
    contrasenia: datosUsuario.get("contrasenia"),
    nombreUsuario: nombreUsuario,
    numeroVisita: 0,
    ultimaVisita: null,
    listaUtiles: [],
  };
  localStorage.setItem(nombreUsuario, JSON.stringify(usuario));
  window.location.href = "index.html";
}
