function calcularTabla(numero) {
  const tabla = document.createElement("table");
  const headerRow = tabla.insertRow();
  const row = tabla.insertRow();
  const th = document.createElement("th");
  th.textContent = "*";
  headerRow.appendChild(th);
  const td = document.createElement("td");
  td.textContent = numero;
  row.appendChild(td);

  for (let index = 1; index < 11; index++) {
    const th = document.createElement("th");
    th.textContent = index;
    headerRow.appendChild(th);
    const td = document.createElement("td");
    td.textContent = index * numero;
    row.appendChild(td);
  }

  document.body.appendChild(tabla);
}
