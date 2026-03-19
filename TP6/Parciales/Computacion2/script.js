function muestraDetalles(nombre) {
    var parametros = "codigo=" + nombre;
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

function detalles(objeto,nombre)
{
    document.getElementById("producto-nombre").innerHTML = nombre;
    const tabla = document.getElementById("tabla-producto-detalle");
    var texto = "";
    var producto = objeto.productos;
    console.log(producto);
    for(i = 0; i<producto.length; i++){
        console.log("Entra");
        texto += `<tr> <td>${producto[i].sucursal}</td>`;
        texto += `<td>${producto[i].cantidad}</td>`;
        texto += `<td><input type="number" min="0" value="0" id='inputCantidad${producto[i].sucursal}'></td>`;
        texto += `<td><input type="button" id="btnAgregar" value="Agregar" onClick="agregarStock('${producto[i].sucursal}','${producto[i].codigo}','${producto[i].nombreProducto}')"</td>`;
        texto += "</tr>";
    }
    tabla.innerHTML = texto;
    muestraElemento("contenedor-detalle");
}

function agregarStock(sucursal,codigo,nombre)
{
    const cantidad = document.getElementById("inputCantidad"+sucursal).value;
    var parametros = "codigo="+codigo+"&sucursal="+sucursal+"&cantidad="+cantidad+"&nombreProdu="+nombre;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "agregarStock.php", true);
    peticion.onreadystatechange = actualizaDetalle;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function actualizaDetalle()
    {
        if ((peticion.readyState == 4) && (peticion.status == 200)) 
        {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            detalles(objeto,nombre);
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