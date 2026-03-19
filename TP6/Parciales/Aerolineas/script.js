function muestraSugerencias(){
    const texto = document.getElementById("IDinputModelo").value;
    var parametros = "modelos="+texto+"&action=modelo";
    var peticion = new XMLHttpRequest();
    peticion.open("POST","procesamiento.php",true);
    peticion.onreadystatechange = mostrarSugerencias;
    peticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    peticion.send(parametros);

    function mostrarSugerencias()
    {
        if  ((peticion.readyState == 4) && (peticion.status == 200))
        {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            var modelos = objeto.modelos;
            const contenedor = document.getElementById("contenedorSugerencias");
            var texto1 = "";
            for (i=0;i<modelos.length;i++){
                id = modelos[i].id_modelo;
                nombre = modelos[i].nombre_modelo;
                texto1 += "<option value='"+nombre+"'></option>";
            }
            contenedor.innerHTML = texto1;
        }
    }
}

function cargaDatos()
{
    const texto = document.getElementById("IDinputModelo").value;
    var parametros = "modelo="+texto+"&action=aviones";
    var peticion = new XMLHttpRequest();
    peticion.open("POST","procesamiento.php",true);
    peticion.onreadystatechange = mostrarAviones;
    peticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    peticion.send(parametros);

    function mostrarAviones()
    {
        if  ((peticion.readyState == 4) && (peticion.status == 200))
        {
            console.log(peticion.responseText);
            var objeto = JSON.parse(peticion.responseText);
            if (objeto.nombre === 'Lleno'){
            modeloValido(true);
            const contenedor = document.getElementById("datosModelo");
            var texto = "<h3>Detalles de la aeronave:</h3><br>";
            texto += "<p>Nombre: "+objeto.nombreCompleto+"</p><br>";
            texto += "<p>Fabricante: "+objeto.fabricante+"</p><br>"
            contenedor.innerHTML = texto;
            var texto2 = "<table class='tabla-moderna'><thead><tr><th>Matricula</th><th>Ingreso a flota</th><th>Capacidad</th><th>Distribucion</th></tr></thead><tbody>";
            const aviones = objeto.aviones;
            for(i=0;i<aviones.length;i++)
            {
                texto2 += "<tr><td>"+aviones[i].matricula+"</td>";
                texto2 += "<td>"+aviones[i].fechaflota+"</td>";
                texto2 += "<td>"+aviones[i].capacidad+"</td>";
                texto2 += "<td>"+aviones[i].distribucion+"</td></tr>";
            }
            texto2 += "</tbody></table>";
            contenedor.innerHTML += texto2;
            muestraElemento("datosModelo");
        }
        else {
            modeloValido(false);
            ocultaElemento("datosModelo");
        }
        }
    }
}

function modeloValido(boolean){
    const valido = document.getElementById("modeloValido");
    switch (boolean){
        case false:
            valido.innerHTML = "<p class='invalido'>Modelo Invalido</p>";
            break;
        case true:
            valido.innerHTML = "<p class='valido'>Modelo Valido</p>";
            break;
        default:
            break;
    }
    muestraElemento("modeloValido");
}
function ocultaElemento(elemento){
    var e = document.getElementById(elemento);
    if(e.classList.contains("oculto")){
        return;
    }else{
    e.classList.add("oculto");
    }
}

function muestraElemento(elemento){
    var e = document.getElementById(elemento);
     if(e.classList.contains("oculto")){
        e.classList.remove("oculto");
    }
}