const BASE_URL = "http://localhost/miproyecto/finalJulio/FinalLab/api";

export async function iniciarPartida(dificultad) {
  const res = await fetch(`${BASE_URL}/IniciarPartida.php`, {
    method: "POST",
    credentials: "include",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ dificultad }),
  });
  return res.json();
}

export async function adivinarLetra(letra) {
  const res = await fetch(`${BASE_URL}/Adivinar.php`, {
    method: "POST",
    credentials: "include",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ letra }),
  });
  return res.json();
}

export async function finalizarPartida() {
  const res = await fetch(`${BASE_URL}/FinalizarPartida.php`, {
    method: "POST",
    credentials: "include",
  });
  return res.json();
}

export async function obtenerRanking() {
  const res = await fetch(`${BASE_URL}/Ranking.php`);
  return res.json();
}
