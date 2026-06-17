var productos = [];

document
  .getElementById("idSeleccionProducto")
  .addEventListener("change", detalleProducto);

function cargarProductos() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      productos = JSON.parse(xhr.responseText);
      var selector = document.getElementById("idSeleccionProducto");
      productos.forEach((producto) => {
        document.createElement("option");
        var option = document.createElement("option");
        option.value = producto.codigoProducto;
        option.innerText = producto.nombreProducto;
        selector.appendChild(option);
      });
    }
  };
  xhr.open("POST", "productos_ajax.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("accion=obtenerProductos");
}

function detalleProducto() {
  var codigoElegido = parseInt(
    document.getElementById("idSeleccionProducto").value,
  );
  var producto = productos.find((p) => p.codigoProducto === codigoElegido);
  console.log(producto);
  var detalleDiv = document.getElementById("idDetalleProducto");
  detalleDiv.style.display = "block";
}

cargarProductos();
