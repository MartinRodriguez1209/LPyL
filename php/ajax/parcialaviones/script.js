function buscarModelo() {
  var busqueda = document.getElementById("nombreReducido").value;

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var datos = JSON.parse(xhr.responseText);

      if (datos.encontrado == true) {
        var tabla = document.getElementById("tablaAviones");
        tabla.innerHTML = "";

        datos.aviones.forEach((a) => {
          var avion = new Avion(
            a.matricula,
            a.fechaIngreso,
            a.capacidad,
            a.distribucion,
          );
          tabla.appendChild(avion.crearFila());
        });

        document.getElementById("resultado").style.display = "block";
      } else {
        document.getElementById("resultado").style.display = "none";
      }
    }
  };

  xhr.open("GET", "aviones.php?nombreReducido=" + busqueda, true);
  xhr.send();
}

class Avion {
  constructor(matricula, fechaIngreso, capacidad, distribucion) {
    this.matricula = matricula;
    this.fechaIngreso = fechaIngreso;
    this.capacidad = capacidad;
    this.distribucion = distribucion;
  }

  crearFila() {
    var row = document.createElement("tr");
    var campos = [
      this.matricula,
      this.fechaIngreso,
      this.capacidad,
      this.distribucion,
    ];

    campos.forEach((campo) => {
      var td = document.createElement("td");
      td.innerText = campo;
      row.appendChild(td);
    });

    return row;
  }
}
