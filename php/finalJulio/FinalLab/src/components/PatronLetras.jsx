const letras = [
  { letra: "G", x: 10, y: 40, rot: -8 },
  { letra: "A", x: 90, y: 25, rot: 10 },
  { letra: "T", x: 180, y: 55, rot: -14 },
  { letra: "O", x: 230, y: 120, rot: 18 },
  { letra: "L", x: 20, y: 130, rot: 15 },
  { letra: "U", x: 120, y: 150, rot: -10 },
  { letra: "N", x: 60, y: 220, rot: 8 },
  { letra: "Z", x: 170, y: 200, rot: -6 },
  { letra: "Ñ", x: 230, y: 245, rot: 20 },
];

function PatronLetras() {
  return (
    <svg
      className="absolute inset-0 w-full h-full pointer-events-none opacity-20"
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs>
        <pattern
          id="patron-letras"
          width="260"
          height="260"
          patternUnits="userSpaceOnUse"
        >
          {letras.map(({ letra, x, y, rot }) => (
            <text
              key={letra}
              x={x}
              y={y}
              fontSize="30"
              fontWeight="bold"
              fill="#2563eb"
              transform={`rotate(${rot} ${x} ${y})`}
            >
              {letra}
            </text>
          ))}
        </pattern>
      </defs>
      <rect width="100%" height="100%" fill="url(#patron-letras)" />
    </svg>
  );
}

export default PatronLetras;
