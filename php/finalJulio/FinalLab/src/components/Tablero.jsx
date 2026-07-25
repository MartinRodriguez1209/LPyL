import { Button, Input } from "./ui";
import { useState, useEffect } from "react";
import { adivinarLetra, finalizarPartida } from "../../api/juego";
import aciertoSound from "../assets/acierto.mp3";
import falloSound from "../assets/fallo.mp3";

function Tablero({
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
  const [letrasArriesgadas, setLetrasArriesgadas] = useState([]);
  const [posicionesPista, setPosicionesPista] = useState([]);
  const [aviso, setAviso] = useState("");
  const segundosPorTiempo = { 1: 60, 3: 180, 5: 300, sin_tiempo: null };
  const [segundosRestantes, setSegundosRestantes] = useState(
    segundosPorTiempo[tiempo],
  );
  // arranca el contador una sola vez
  useEffect(() => {
    if (segundosPorTiempo[tiempo] === null) return;
    const intervalId = setInterval(() => {
      setSegundosRestantes((prev) => (prev > 0 ? prev - 1 : 0));
    }, 1000);

    return () => clearInterval(intervalId);
  }, []);

  const perderPartida = async () => {
    await finalizarPartida();
    onTerminar({
      gano: false,
      empate: false,
      puntajeAcumulado: 0,
      puntajeLetras,
      pistasUsadas,
    });
  };

  // reacciona cuando el contador llega a 0
  useEffect(() => {
    if (segundosRestantes === 0) {
      perderPartida();
    }
  }, [segundosRestantes]);

  const handleArriesgarLetra = async (e) => {
    e.preventDefault();
    if (letra.trim().length !== 1) {
      setAviso("Ingresá una sola letra");
      return;
    }
    const data = await adivinarLetra(letra);
    if (!data.ok) {
      setAviso(data.mensaje);
      return;
    }
    if (data.yaArriesgada) {
      setAviso("Ya arriesgaste esa letra");
      setLetra("");
      return;
    }
    setAviso("");
    new Audio(data.acerto ? aciertoSound : falloSound).play();
    if (!data.acerto) {
      const anterior = palabraActual.replaceAll(" ", "");
      const nuevas = [];
      for (let i = 0; i < data.mascara.length; i++) {
        if (anterior[i] === "*" && data.mascara[i] !== "*") nuevas.push(i);
      }
      setPosicionesPista((prev) => [...prev, ...nuevas]);
    }
    setPalabraActual(data.mascara);
    setPistasUsadas(data.puntajePistas);
    setPuntajeLetras(data.puntajeLetras);
    setCantidadIntentos((prev) => prev + 1);
    setLetrasArriesgadas((prev) => [...prev, letra]);
    setLetra("");
    if (data.completada) {
      onTerminar({
        gano: data.gano,
        empate: data.empate,
        puntajeAcumulado: data.puntajeAcumulado,
        puntajeLetras: data.puntajeLetras,
        pistasUsadas: data.puntajePistas,
        palabra: data.mascara,
      });
    }
  };

  return (
    <div className="relative flex-1 flex flex-col items-center p-6 gap-6">
      <div className="w-full max-w-2xl grid grid-cols-3 gap-2 bg-white rounded-lg p-4 shadow text-sm text-gray-700">
        <span>Dificultad: {dificultad}</span>
        <span className="text-center">
          Tiempo: {segundosRestantes === null ? "Sin límite" : segundosRestantes}
        </span>
        <span className="text-right">Intentos: {cantidadIntentos}</span>

        <span></span>
        <span className="text-center">Letras: {cantidadLetras}</span>
        <span></span>
      </div>
      <div className="flex gap-2">
        {palabraActual
          .replaceAll(" ", "")
          .split("")
          .map((letra, i) => (
            <div
              key={i}
              className={`w-12 h-12 flex items-center justify-center text-2xl font-bold rounded ${
                letra === "*"
                  ? "bg-gray-200 text-gray-400"
                  : posicionesPista.includes(i)
                    ? "bg-yellow-500 text-white"
                    : "bg-green-900 text-white"
              }`}
            >
              {letra === "*" ? "*" : letra.toUpperCase()}
            </div>
          ))}
      </div>
      <form onSubmit={handleArriesgarLetra} className="flex gap-2">
        <Input
          placeholder="Letra"
          className="w-20 text-center"
          maxLength={1}
          value={letra}
          onChange={(e) => setLetra(e.target.value)}
        />
        <Button type="submit">Arriesgar</Button>
      </form>
      {aviso && <p className="text-red-500 text-sm">{aviso}</p>}
      <Button type="button" onClick={perderPartida}>
        Abandonar partida
      </Button>
      <div className="w-full max-w-2xl bg-white rounded-lg p-4 shadow text-sm">
        Letras arriesgadas: {letrasArriesgadas.join(", ")}
      </div>
      <div className="w-full max-w-2xl grid grid-cols-3 gap-2 bg-white rounded-lg p-4 shadow text-sm text-gray-700">
        <span className="text-left">Puntaje = {puntajeLetras}</span>
        <span className="text-end">Pistas usadas = {pistasUsadas}</span>
      </div>
    </div>
  );
}
export default Tablero;
