const colores = ["#f87171", "#facc15", "#4ade80", "#60a5fa", "#c084fc"];

function Confeti() {
  const piezas = Array.from({ length: 40 });
  const aviones = Array.from({ length: 4 });

  return (
    <div className="absolute inset-0 overflow-hidden pointer-events-none">
      {piezas.map((_, i) => (
        <div
          key={i}
          style={{
            position: "absolute",
            left: `${Math.random() * 100}%`,
            top: "-10px",
            width: 8,
            height: 8,
            backgroundColor: colores[i % colores.length],
            animation: `caer ${3 + Math.random() * 2}s linear ${Math.random() * 2}s infinite`,
          }}
        />
      ))}
      {aviones.map((_, i) => (
        <span
          key={i}
          className="text-2xl"
          style={{
            position: "absolute",
            top: `${10 + Math.random() * 70}%`,
            left: 0,
            animation: `volar ${4 + Math.random() * 3}s linear ${Math.random() * 3}s infinite`,
          }}
        >
          ✈️
        </span>
      ))}
    </div>
  );
}

export default Confeti;
