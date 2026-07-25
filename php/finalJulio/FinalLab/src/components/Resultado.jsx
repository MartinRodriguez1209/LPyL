import { Button } from "./ui";
import Ranking from "./Ranking";
import Confeti from "./Confeti";
import PatronLetras from "./PatronLetras";

function Resultado({ resultado, onNuevaPartida, onLogout }) {
  const mensaje = resultado.gano
    ? "Felicidades, ganaste!"
    : resultado.empate
      ? "Empataste!"
      : "Perdiste!";
  const colorMensaje = resultado.gano
    ? "text-green-900"
    : resultado.empate
      ? "text-yellow-600"
      : "text-red-600";
  return (
    <div className="min-h-screen relative overflow-hidden flex items-center justify-center bg-gray-100">
      <PatronLetras />
      {resultado.gano && <Confeti />}
      <div className="relative bg-white rounded-xl shadow-md p-8 w-full max-w-sm text-center">
        <h2 className={`text-xl font-bold mb-4 ${colorMensaje}`}>{mensaje}</h2>

        <p>Has adiviniado {resultado.puntajeLetras} letras!</p>
        <p>Has recibido {resultado.pistasUsadas} pistas!</p>
        <p>Tu puntaje total es de {resultado.puntajeAcumulado}!</p>
        {resultado.palabra && <p>La palabra era: {resultado.palabra}</p>}
        <Ranking></Ranking>
        <Button type="button" className="w-full mt-3" onClick={onNuevaPartida}>
          Jugar de nuevo
        </Button>
        <Button type="button" className="w-full mt-3" onClick={onLogout}>
          Cerrar sesión
        </Button>
      </div>
    </div>
  );
}

export default Resultado;
