export async function loginApi(usuario, password) {
  const res = await fetch(
    "http://localhost/miproyecto/finalJulio/FinalLab/api/Login.php",
    {
      method: "POST",
      credentials: "include",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ usuario, password }),
    },
  );
  return res.json();
}

export async function registroApi(usuario, mail, password) {
  const res = await fetch(
    "http://localhost/miproyecto/finalJulio/FinalLab/api/Registro.php",
    {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ usuario, mail, password }),
    },
  );
  return res.json();
}
