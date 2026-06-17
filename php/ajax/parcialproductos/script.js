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
  document.getElementById("idNombre").innerText = producto.nombreProducto;
  document.getElementById("idProveedor").innerText = producto.proveedor;
  document.getElementById("idTotalStock").innerText = producto.totalStock;

  var tablaStocks = document.getElementById("idTablaBody");
  tablaStocks.innerHTML = "";
  for (var sucursal in producto.stockSucursal) {
    var tr = document.createElement("tr");
    var tdSucursal = document.createElement("td");
    tdSucursal.innerText = sucursal;
    tr.appendChild(tdSucursal);
    var tdStockActual = document.createElement("td");
    tdStockActual.innerText = producto.stockSucursal[sucursal];
    tr.appendChild(tdStockActual);
    tablaStocks.appendChild(tr);
  }
}

cargarProductos();
