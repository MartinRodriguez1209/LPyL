import { useState } from "react";
import { iniciarPartida } from "../../api/juego";
import SeleccionPartida from "./SeleccionPartida";
import Tablero from "./Tablero";

function Juego({ usuario, onTerminar }) {
  const [partidaIniciada, setPartidaIniciada] = useState(false);
  const [dificultad, setDificultad] = useState("baja");
  const [tiempo, setTiempo] = useState("sin_tiempo");
  const [cantidadLetras, setCantidadLetras] = useState(0);
  const [palabraActual, setPalabraActual] = useState("");

  const handleIniciarPartida = async () => {
    setPartidaIniciada(true);
    const data = await iniciarPartida(dificultad, usuario.id);
    setCantidadLetras(data.cantidadLetras);
    setPalabraActual(Array(data.cantidadLetras).fill("*").join(" "));
  };

  if (!partidaIniciada) {
    return (
      <SeleccionPartida
        dificultad={dificultad}
        setDificultad={setDificultad}
        tiempo={tiempo}
        setTiempo={setTiempo}
        onIniciar={handleIniciarPartida}
      />
    );
  }
  return (
    <Tablero
      usuario={usuario}
      dificultad={dificultad}
      tiempo={tiempo}
      cantidadLetras={cantidadLetras}
      palabraActual={palabraActual}
      setPalabraActual={setPalabraActual}
      onTerminar={onTerminar}
    />
  );
}

export default Juego;
