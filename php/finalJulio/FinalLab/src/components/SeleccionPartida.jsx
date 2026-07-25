import { Button } from "./ui";

function SeleccionPartida({
  dificultad,
  setDificultad,
  tiempo,
  setTiempo,
  onIniciar,
}) {
  return (
    <div className="relative flex-1 flex items-center justify-center">
      <div className="bg-white rounded-xl shadow-md p-8 w-full max-w-sm">
        <h2 className="text-xl font-bold mb-4">Elegí la partida</h2>
        <div className="mb-2">
          <span className="block mb-2 text-sm font-medium text-gray-900">
            Dificultad
          </span>
          <div className="flex gap-2">
            <button
              type="button"
              onClick={() => setDificultad("baja")}
              className={`flex-1 py-2 rounded-lg font-medium ${
                dificultad === "baja"
                  ? "bg-green-600 text-white"
                  : "bg-green-100 text-green-700"
              }`}
            >
              Baja
            </button>
            <button
              type="button"
              onClick={() => setDificultad("media")}
              className={`flex-1 py-2 rounded-lg font-medium ${
                dificultad === "media"
                  ? "bg-yellow-500 text-white"
                  : "bg-yellow-100 text-yellow-700"
              }`}
            >
              Media
            </button>
            <button
              type="button"
              onClick={() => setDificultad("alta")}
              className={`flex-1 py-2 rounded-lg font-medium ${
                dificultad === "alta"
                  ? "bg-red-600 text-white"
                  : "bg-red-100 text-red-700"
              }`}
            >
              Alta
            </button>
          </div>
        </div>
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
