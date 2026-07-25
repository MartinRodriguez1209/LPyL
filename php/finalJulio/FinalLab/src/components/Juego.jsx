import { useState } from "react";
import { iniciarPartida } from "../../api/juego";
import { Button } from "./ui";
import SeleccionPartida from "./SeleccionPartida";
import Tablero from "./Tablero";
import PatronLetras from "./PatronLetras";

function Juego({ usuario, onTerminar, onLogout }) {
  const [partidaIniciada, setPartidaIniciada] = useState(false);
  const [dificultad, setDificultad] = useState("baja");
  const [tiempo, setTiempo] = useState("sin_tiempo");
  const [cantidadLetras, setCantidadLetras] = useState(0);
  const [palabraActual, setPalabraActual] = useState("");

  const handleIniciarPartida = async () => {
    const data = await iniciarPartida(dificultad);
    setCantidadLetras(data.cantidadLetras);
    setPalabraActual(Array(data.cantidadLetras).fill("*").join(" "));
    setPartidaIniciada(true);
  };

  return (
    <div className="min-h-screen relative overflow-hidden bg-gray-100 flex flex-col">
      <PatronLetras />
      <header className="relative w-full flex justify-between items-center bg-white shadow px-6 py-4">
        <span className="font-medium text-gray-900">
          Hola {usuario.nombreUsuario}
        </span>
        <Button type="button" onClick={onLogout}>
          Cerrar sesión
        </Button>
      </header>

      {!partidaIniciada ? (
        <SeleccionPartida
          dificultad={dificultad}
          setDificultad={setDificultad}
          tiempo={tiempo}
          setTiempo={setTiempo}
          onIniciar={handleIniciarPartida}
        />
      ) : (
        <Tablero
          dificultad={dificultad}
          tiempo={tiempo}
          cantidadLetras={cantidadLetras}
          palabraActual={palabraActual}
          setPalabraActual={setPalabraActual}
          onTerminar={onTerminar}
        />
      )}
    </div>
  );
}

export default Juego;
