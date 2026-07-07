import { Button } from "./ui";

function SeleccionPartida({
  dificultad,
  setDificultad,
  tiempo,
  setTiempo,
  onIniciar,
}) {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <div className="bg-white rounded-xl shadow-md p-8 w-full max-w-sm">
        <h2 className="text-xl font-bold mb-4">Elegí la partida</h2>
        <label className="block mb-2 text-sm font-medium text-gray-900">
          Dificultad
          <select
            value={dificultad}
            onChange={(e) => setDificultad(e.target.value)}
            className="w-full border border-gray-300 rounded-lg p-2.5"
          >
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
          </select>
        </label>
        <label className="block mb-2 text-sm font-medium text-gray-900">
          Tiempo
          <select
            value={tiempo}
            onChange={(e) => setTiempo(e.target.value)}
            className="w-full border border-gray-300 rounded-lg p-2.5"
          >
            <option value="sin_tiempo">Sin tiempo</option>
            <option value="1">1 minuto</option>
            <option value="3">3 minutos</option>
            <option value="5">5 minutos</option>
          </select>
        </label>
        <Button type="button" className="w-full mt-3" onClick={onIniciar}>
          Comenzar
        </Button>
      </div>
    </div>
  );
}
export default SeleccionPartida;
