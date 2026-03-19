function verDetalle(nombre) {
    var parametros = "action=detalles&nombreProdu=" + nombre;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "procesamiento.php", true);
    peticion.onreadystatechange = mostrarProductoDetalle;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function mostrarProductoDetalle() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            detalles(objeto,nombre);
        }
    }
}

function detalles(objeto, nombre) {
    const producto = objeto.productos;
    //
    const detalleProducto = document.getElementById("detalle-producto");
    const tablaSuc = document.getElementById("tabla-sucursales");
    var detalles = "<h3>Datos del producto</h3>";
    detalles += "<p>Nombre Producto: " + nombre + "</p>";
    var proveedor = "";
    var stock = 0;
    var texto = "";
    if (producto.length > 0) {
        for (i = 0; i < producto.length; i++) {
            proveedor = producto[i].proveedor;
            stock += parseInt(producto[i].cantidad);
            texto += "<tr>";
            texto += "<td>" + producto[i].sucursal + "</td>";
            texto += "<td>" + producto[i].cantidad + "</td>";
            texto += "<td>" + producto[i].fecha + "</td>";
            texto += "<td><input type='text' value='0' id='idStock" + i + "'  size='2'></td>";
            texto += "<td><input type='button' value='Agregar Stock' onClick=\"agregarStock('" + producto[i].codigo + "','"+producto[i].sucursal+"','"+producto[i].nombreProducto+"','idStock" + i + "');\"></td>";
            texto += "</tr>";
        }
    }
    detalles += "<p>Proveedor: " + proveedor + "</p>";
    detalles += "<p>Stock total: " + stock + "</p><br>";
    detalleProducto.innerHTML = detalles;
    tablaSuc.innerHTML = texto;
    muestraElemento("detalles");
}

function agregarStock(codigo,sucursal,producto, cant) {
    const cantidad = document.getElementById(cant).value;
    var parametros = "action=detalles&cantidad=" + cantidad + "&sucursal=" + sucursal + "&codigo=" + codigo + "&nombreProdu="+producto;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "procesamiento.php", true);
    peticion.onreadystatechange = actualizarStock;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function actualizarStock() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const mensaje = objeto.mensaje;
            const contMensaje = document.getElementById("mensaje");
            contMensaje.innerHTML = mensaje;
            detalles(objeto, producto);
        }
    }
}

function filtraProductos() {
    const filtro1 = document.getElementById("inputProductos").value;
    var parametros = "action=filtra&idInput=" + filtro1;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "procesamiento.php", true);
    peticion.onreadystatechange = productosFiltrados;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function productosFiltrados() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const productos = objeto.productos;
            const tablaProductos = document.getElementById("tabla-productos");
            var texto = "";
            if (productos.length > 0) {
                for (i = 0; i < productos.length; i++) {
                    texto += "<tr>";
                    texto += "<td onClick=\"verDetalle('" + productos[i].nombreProducto + "');\">" + productos[i].nombreProducto + "</td>";
                    texto += "</tr>";
                }
            } else {
                texto += "<p>No existen productos</p>";
            }
            tablaProductos.innerHTML = texto;
            ocultaElemento("detalles");
        }
    }

}

function ocultaElemento(elemento) {
    var e = document.getElementById(elemento);
    if (e.classList.contains("oculto")) {
        return;
    } else {
        e.classList.add("oculto");
    }
}

function muestraElemento(elemento) {
    var e = document.getElementById(elemento);
    if (e.classList.contains("oculto")) {
        e.classList.remove("oculto");
    }
}