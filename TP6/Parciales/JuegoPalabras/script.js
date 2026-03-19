const puntajeActual = document.getElementById("puntajeActual");
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

function habilita(elemento) {
    document.getElementById(elemento).disabled = false;
}

function desabilita(elemento) {
    document.getElementById(elemento).disabled = true;

}

function desabilitaBtneInputs() {
    desabilita("inputPalabra");
    desabilita("btnAbandona");
    desabilita("btnArriesga");
}

function habilitaBtneInputs() {
    habilita("inputPalabra");
    habilita("btnAbandona");
    habilita("btnArriesga");
}

function arriesgar() {
    const palabra = document.getElementById("palabraActual").value.toLowerCase();
    const arriesgada = document.getElementById("inputPalabra").value.toLowerCase();
    const resultado = document.getElementById("resultadoPartida");
    var texto = "";
    if (palabra === arriesgada) {
        texto += "<p>Felicidades, acertaste la palabra, es: " + document.getElementById("palabraActual").value + "</p>";
        if (parseInt(puntajeActual.textContent) == 80) {
            texto += "<p>Ganaste con " + 100 + " puntos!</p>";
        } else {
            texto += "<p>Ganaste con " + puntajeActual.textContent + " puntos!</p>";
        }
        desabilita("btnPista");
        document.getElementById("vecesAdivinada").textContent = actualizaAcertada();
    } else {
        texto += "<p>Perdiste, suerte en la proxima</p>";
    }
    texto += generaBtnNuevaPartida();
    resultado.innerHTML = texto;
    muestraElemento("resultadoPartida");
    desabilitaBtneInputs();
}

function actualizaAcertada()
{
    const id = document.getElementById("idPalabra").value;
    var parametros = "action="+id;
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "actualizaAcertada.php", true);
    peticion.onreadystatechange = actualiza;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);
    function actualiza()
    {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            document.getElementById("vecesAdivinada").textContent = objeto.acertada;
        }
    }
    
}

function generaBtnNuevaPartida() {
    return "<input type='button' value='Nueva Partida' onClick='nuevaPartida();'>";
}

function abandonar() {
    const resultado = document.getElementById("resultadoPartida");
    var texto = "<p>Perdiste, suerte en la proxima</p>";
    texto += generaBtnNuevaPartida();
    resultado.innerHTML = texto;
    desabilitaBtneInputs();
    muestraElemento("resultadoPartida");
}

function muestraPista(numPista) {
    puntaje = parseInt(puntajeActual.textContent) - 15;
    puntajeActual.innerHTML = puntaje;
    numPista = parseInt(numPista.value);
    numPista = (numPista + 1);
    if (numPista < 6) {
        var pistasDisp = document.getElementById("cantPistas");
        var pistasDi = parseInt(pistasDisp.textContent) - 1;
        pistasDisp.innerHTML = pistasDi;
        muestraElemento("idpista" + String(numPista));
        document.getElementById("numpista").value = numPista;
    } else {
        alert("Ya no tienes pistas disponibles");
        puntajeActual.innerHTML = 5;
        desabilita("btnPista");
    }
}

function nuevaPartida() {
    var parametros = "action=nuevaPartida";
    console.log(parametros);
    var peticion = new XMLHttpRequest();
    peticion.open("POST", "procesamiento.php", true);
    peticion.onreadystatechange = generaNuevaPartida;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send(parametros);

    function generaNuevaPartida() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            const palabra = objeto.palabra;
            const pistas = objeto.pistas;
            document.getElementById("idPalabra").value = palabra.idpalabra;
            document.getElementById("palabraActual").value = palabra.nomPalabra;
            document.getElementById("longitudPalabra").textContent = palabra.nomPalabra.length;
            document.getElementById("dificultaPalabra").textContent = palabra.dificultad;
            document.getElementById("vecesAdivinada").textContent = palabra.acertada;
            document.getElementById("puntajeActual").textContent = 80;
            document.getElementById("cantPistas").textContent = 5;
            document.getElementById("numpista").value = 0;
            document.getElementById("inputPalabra").value = "";
            const contPistas = document.getElementById("pistasVisibles");
            var texto = "";
            for (i = 0; i < pistas.length; i++) {
                texto += "<tr id='idpista" + pistas[i].ordenPista + "' class='oculto'>";
                texto += "<td>" + pistas[i].pista + "</td>";
                texto += "</tr>";
            }
            contPistas.innerHTML = texto;
            habilitaBtneInputs();
            habilita("btnPista");
            ocultaElemento("resultadoPartida");
        }
    }
}