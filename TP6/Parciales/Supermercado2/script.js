function filtraProductos()
{
    const filtro1 = document.getElementById("idFiltrosProductos").value;
    const filtro2 = document.getElementById("idFiltrosUbicacion").value;
    var parametros = "";
    if(filtro1 !== "" && filtro2 !== "")
    {
        parametros += "action=ambos";
        parametros += "&producto="+filtro1;
        parametros += "&ubicacion="+filtro2;
    } else if (filtro1 !== "")
        {
            parametros += "action=producto";
            parametros += "&producto="+filtro1;
    } else if (filtro2 !== "")
        {
            parametros += "action=ubicacion";
            parametros += "&ubicacion="+filtro2;
    } else {
        parametros += "action=ninguno";
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
            const contenedor = document.getElementById("contenedor-productos");
            var texto = "";
            for(i=0 ; i<productos.length; i++)
            {
                texto += `<tr onClick="detalleProducto('${productos[i].nombreProdu}');">`;
                texto += `<td>${productos[i].nombreProdu}</td>`;
                texto += `<td>${productos[i].precio}</td>`;
                texto += `<td>${productos[i].nombreSuper}</td>`;
                texto += `<td>${productos[i].ubicacion}</td>`;
                texto += "</tr>";
            }
            contenedor.innerHTML = texto;
            ocultaElemento("div-info");
        }
    }
}

function detalleProducto(nombre)
{
    var parametros = "nombre="+nombre;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "infoProducto.php", true);
    peticion.onreadystatechange = productoDetallado;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function productoDetallado() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const producto = objeto.producto;
            const contenedor = document.getElementById("tabla-producto");
            document.getElementById("caption-producto").innerHTML = nombre;
            const informacion = document.getElementById("informacion");
            var texto = "";
            for(i=0 ; i<producto.length; i++)
            {
                texto += `<tr>`;
                texto += `<td>${producto[i].nombreSuper}</td>`;
                texto += `<td>${producto[i].precio}</td>`;
                texto += `<td>${producto[i].ubicacion}</td>`;
                texto += "</tr>";
            }
            contenedor.innerHTML = texto;
            texto = "";
            precioBajo = producto[0].precio;
            precioAlto = producto[producto.length-1].precio;
            texto = `<p>Supermercado con el precio mas economico es ${producto[0].nombreSuper} - ${producto[0].ubicacion}</p>`;            
            texto = `<p>Diferencia entre precio mas bajo y mas alto: ${precioBajo} - ${precioAlto} = ${(precioAlto-precioBajo)}</p>`;    
            informacion.innerHTML = texto;        
            muestraElemento("div-info");
        }
    }
}

function ocultaElemento(elemento) 
{
    var e = document.getElementById(elemento);
    if (e.classList.contains("oculto")) {
        return;
    } else {
        e.classList.add("oculto");
    }
}

function muestraElemento(elemento) 
{
    var e = document.getElementById(elemento);
    if (e.classList.contains("oculto")) {
        e.classList.remove("oculto");
    }
}