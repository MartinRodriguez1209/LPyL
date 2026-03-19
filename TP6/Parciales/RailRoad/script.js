function muestraServicios(id) {
    const filtro1 = document.getElementById("idFiltrosOrigen").value;
    const filtro2 = document.getElementById("idFiltrosDestino").value;
    var parametros = "idEmpresa=" + id;

    if (filtro1 !== "" && filtro2 !== "") {
        parametros += "&idOrigen=" + filtro1;
        parametros += "&idDestino=" + filtro2;
        parametros += "&action=Ambos";
    } else if (filtro1 !== "") {
        parametros += "&idOrigen=" + filtro1;
        parametros += "&action=Origen";
    } else if (filtro2 !== "") {
        parametros += "&idDestino=" + filtro2;
        parametros += "&action=Destino";
    } else {
        parametros += "&idNinguno=ninguno";
        parametros += "&action=Todo";
    }
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "procesamientoServicios.php", true);
    peticion.onreadystatechange = mostrarServicios;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function mostrarServicios() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const nombreEmpresa = objeto.nombreEmpresa;
            const servicios = objeto.servicios;
            const titulo = document.getElementById("titulo-tabla");
            titulo.innerHTML = "<h3>"+nombreEmpresa+"</h3>";
            const header = document.getElementById("header-tabla");
            const body = document.getElementById("cuerpo-tabla");
            header.innerHTML = "<tr><th>Nro Servicio</th><th>Estacion Origen</th><th>Estacion Destino</th><th>Hora Salida</th><th>Hora Llegada</th><th>Frecuencia</th><th>Precio</th></tr>"
            var texto = "";
            for (i = 0; i < servicios.length; i++) {
                texto += "<tr>";
                texto += "<td>" + servicios[i].nroServicio + "</td>";
                texto += "<td>" + servicios[i].estacionOrigen + "</td>";
                texto += "<td>" + servicios[i].estacionDestino + "</td>";
                texto += "<td>" + servicios[i].horaSalida + "</td>";
                texto += "<td>" + servicios[i].horaLlegada + "</td>";
                texto += "<td>" + servicios[i].frecuencia + "</td>";
                texto += "<td>" + servicios[i].precio + "</td>";
                texto += "</tr>";
            }
            body.innerHTML = texto;
            muestraElemento("contenedor-servicios");
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

function filtraEmpresas() {
    const filtro1 = document.getElementById("idFiltrosOrigen").value;
    const filtro2 = document.getElementById("idFiltrosDestino").value;
    var parametros;
    if (filtro1 !== "" && filtro2 !== "") {
        parametros = "idOrigen=" + filtro1;
        parametros += "&idDestino=" + filtro2;
        parametros += "&action=Ambos";
    } else if (filtro1 !== "") {
        parametros = "idOrigen=" + filtro1;
        parametros += "&action=Origen";
    } else if (filtro2 !== "") {
        parametros = "idDestino=" + filtro2;
        parametros += "&action=Destino";
    } else {
        parametros = "idNinguno=ninguno";
        parametros += "&action=Todo";
    }

    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "procesamientoEmpresas.php", true);
    peticion.onreadystatechange = empresasFiltradas;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function empresasFiltradas() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const empresas = objeto.empresas;
            const listaEmpresas = document.getElementById("listaEmpresas");
            var texto = "";
            if (empresas.length > 0) {
                for (i = 0; i < empresas.length; i++) {
                    texto += "<li>";
                    texto += "<a href='" + empresas[i].webEmpresa + "'><img src='" + empresas[i].logoEmpresa + "'> </a>";
                    texto += "<h3>";
                    texto += "<p>Nombre: " + empresas[i].nombreEmpresa + "</p><br>";
                    texto += "<p>Pais: " + empresas[i].paisEmpresa + "</p><br>";
                    texto += "<a href='" + empresas[i].webEmpresa + "'>Sitio Web</a><br>";
                    texto += "<p>Servicios: " + empresas[i].cantidadServicios + "</p><br>";
                    texto += "<input type='button' value='Ver Servicios' onClick='muestraServicios(" + empresas[i].idEmpresa + ")'>";
                    texto += "</h3>";
                    texto += "</li>";
                }
            } else {
                texto += "<li><h3>No hay empresas que hagan este recorrido</h3></li>";
            }
            listaEmpresas.innerHTML = texto;
            ocultaElemento("contenedor-servicios");
        }
    }

}