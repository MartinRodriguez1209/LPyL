import { Button, Input } from "./ui";
import { useState } from "react";
import { adivinarLetra } from "../../api/juego";

function Tablero({
  usuario,
  dificultad,
  tiempo,
  cantidadLetras,
  palabraActual,
  setPalabraActual,
  onTerminar,
}) {
  const [cantidadIntentos, setCantidadIntentos] = useState(0);
  const [letra, setLetra] = useState("");
  const [puntajeLetras, setPuntajeLetras] = useState(0);
  const [pistasUsadas, setPistasUsadas] = useState(0);
  const [letrasArriesgadas, setLetrasArriesgadas] = useState("");

  const handleArriesgarLetra = async (e) => {
    e.preventDefault();
    const data = await adivinarLetra(letra);
    console.log(data);
    setPalabraActual(data.mascara);
    setPistasUsadas(data.puntajePistas);
    setPuntajeLetras(data.puntajeLetras);
    setCantidadIntentos((prev) => prev + 1);
    setLetrasArriesgadas((prev) => prev + letra + ", ");
    setLetra("");
    if (data.completada) {
      onTerminar({
        gano: data.gano,
        empate: data.empate,
        puntajeAcumulado: data.puntajeAcumulado,
        puntajeLetras: data.puntajeLetras,
        pistasUsadas: data.puntajePistas,
      });
    }
  };

  return (
    <div className="min-h-screen bg-gray-100">
      <header className="w-full flex justify-between items-center bg-white shadow px-6 py-4">
        <span className="font-medium text-gray-900">
          Hola {usuario.nombreUsuario}
        </span>
        <Button type="button">Cerrar sesión</Button>
      </header>

      <div className="min-h-screen bg-gray-100 flex flex-col items-center p-6 gap-6">
        <div className="w-full max-w-2xl grid grid-cols-3 gap-2 bg-white rounded-lg p-4 shadow text-sm text-gray-700">
          <span>Dificultad: {dificultad}</span>
          <span className="text-center">Tiempo: {tiempo}</span>
          <span className="text-right">Intentos: {cantidadIntentos}</span>

          <span></span>
          <span className="text-center">Letras: {cantidadLetras}</span>
          <span></span>
        </div>
        <div className="text-4xl font-bold tracking-widest">
          {palabraActual}
        </div>
        <form onSubmit={handleArriesgarLetra} className="flex gap-2">
          <Input
            placeholder="Letra"
            className="w-20 text-center"
            value={letra}
            onChange={(e) => setLetra(e.target.value)}
          />
          <Button type="submit">Arriesgar</Button>
        </form>
        <div className="w-full max-w-2xl bg-white rounded-lg p-4 shadow text-sm">
          Letras arriesgadas: {letrasArriesgadas}
        </div>
        <div className="w-full max-w-2xl grid grid-cols-3 gap-2 bg-white rounded-lg p-4 shadow text-sm text-gray-700">
          <span className="text-left">Puntaje = {puntajeLetras}</span>
          <span className="text-end">Pistas usadas = {pistasUsadas}</span>
        </div>
      </div>
    </div>
  );
}
export default Tablero;
