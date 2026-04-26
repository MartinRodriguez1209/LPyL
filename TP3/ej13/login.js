document
  .getElementById("idIniciarSesion")
  .addEventListener("click", iniciarSesion);

function iniciarSesion() {
  const formData = new FormData(document.getElementById("idFormLogin"));
  const nombreUsuario = localStorage.getItem(formData.get("nombreUsuario"));
  if (nombreUsuario === null) {
    window.alert("El nombre de usuario no existe");
    return;
  }
  const usuario = JSON.parse(nombreUsuario);

  if (usuario.contrasenia === formData.get("contrasenia")) {
    usuario.numeroVisita += 1;
    sessionStorage.setItem("usuarioActual", JSON.stringify(usuario));
    usuario.ultimaVisita = new Date().toLocaleDateString("es-AR");
    localStorage.setItem(usuario.nombreUsuario, JSON.stringify(usuario));

    window.location.href = "peppaPig.html";
  } else {
    window.alert("CONTRASEÑA INCORRECTA");
  }
}
