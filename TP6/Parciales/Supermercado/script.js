function verDetalle(nombre) {
    var parametros = "nombreProdu=" + nombre;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "verDetalle.php", true);
    peticion.onreadystatechange = mostrarProductoDetalle;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function mostrarProductoDetalle() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const productos = objeto.productos;
            const infoDisp = document.getElementById("info-disponibilidad");
            var texto = "";
            var precioBajo = productos[0];
            var precioAlto = null;
            if (productos.length > 0) {
                document.getElementById("contenedor-nombre").innerHTML = nombre;
                for (i = 0; i < productos.length; i++) {
                    texto += "<tr>";
                    texto += "<td>"+productos[i].nombreSuper+"</td>";
                    texto += "<td>"+productos[i].precio+"</td>";
                    texto += "<td>"+productos[i].ubicacion+"</td>";
                    texto += "</tr>";
                    precioAlto = productos[i];
                }
            }
            const footer = document.getElementById("resumen");
            var bajo = parseInt(precioBajo.precio);
            var alto = parseInt(precioAlto.precio);
            var texto2 = "Precio mas economico: "+precioBajo.nombreSuper+" - "+ precioBajo.ubicacion+"<br>";
            texto2 += "Diferencia entre mas bajo y mas alto: "+alto+" - "+bajo+" = "+(alto-bajo);
            footer.innerHTML = texto2;
            infoDisp.innerHTML = texto;
            muestraElemento("infoProducto");
        }
    }
}

function filtraProductos() {
    const filtro1 = document.getElementById("idFiltrosProductos").value;
    //const filtro1 = document.getElementById("inputProductos").value; Este es para el input, funciona igual a la linea de arriba, queda para copiar y pegar en proximo lab
    const filtro2 = document.getElementById("idFiltrosUbicacion").value;
    var parametros;
    if (filtro1 !== "" && filtro2 !== "") {
        parametros = "nombreProdu=" + filtro1;
        parametros += "&ubicacion=" + filtro2;
        parametros += "&action=Ambos";
    } else if (filtro1 !== "") {
        parametros = "nombreProdu=" + filtro1;
        parametros += "&action=Nombre";
    } else if (filtro2 !== "") {
        parametros = "ubicacion=" + filtro2;
        parametros += "&action=Ubicacion";
    } else {
        parametros = "idNinguno=ninguno";
        parametros += "&action=Todo";
    }

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
                    texto += "<td>"+productos[i].nombreProducto+"</td>";
                    texto += "<td>"+productos[i].precio+"</td>";
                    texto += "<td>"+productos[i].nombreSuper+"</td>";
                    texto += "<td>"+productos[i].ubicacion+"</td>";
                    texto += "<td><input type='button' value='Ver Detalle' onClick=\"verDetalle('" +productos[i].nombreProducto+ "');\"></td>";
                    texto += "</tr>";
                }
            } else {
                
            }
            tablaProductos.innerHTML = texto;
            ocultaElemento("infoProducto");
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