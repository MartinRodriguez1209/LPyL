document.getElementById("idBotonPopUp").addEventListener("click", abrirVentana);

function abrirVentana() {
  window.open("popup.html", "ventana", "width=600,height=400,left=200,top=100");
}
const myDialog = document.getElementById("favDialog");
document
  .getElementById("idBotonPopUpDialog")
  .addEventListener("click", abrirDialog);

function abrirDialog() {
  myDialog.showModal();
}
document.getElementById("closeBtn").addEventListener("click", () => {
  myDialog.close();
});
