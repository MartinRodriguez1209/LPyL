import { useState, useEffect } from "react";
import { obtenerRanking } from "../../api/juego";

function Ranking() {
  const [ranking, setRanking] = useState([]);

  useEffect(() => {
    const cargarRanking = async () => {
      const data = await obtenerRanking();
      setRanking(data);
    };
    cargarRanking();
  }, []);

  return (
    <div className="w-full max-w-2xl bg-white rounded-lg p-4 shadow text-sm">
      <h3 className="font-bold mb-2">Top 10</h3>
      <div className="flex justify-between font-medium text-gray-500 border-b pb-1 mb-1">
        <span>Usuario</span>
        <span>Puntaje</span>
      </div>
      {ranking.map((fila, i) => (
        <div key={fila.nombre_usuario} className="flex justify-between">
          <span>
            {i + 1}. {fila.nombre_usuario}
          </span>
          <span>{fila.puntaje_total}</span>
        </div>
      ))}
    </div>
  );
}

export default Ranking;
