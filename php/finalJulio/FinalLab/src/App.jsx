import { useState } from "react";
import Login from "./components/Login";
import Registro from "./components/Registro";
import Juego from "./components/Juego";
import Resultado from "./components/Resultado";

function App() {
  const [pantalla, setPantalla] = useState("login");
  const [usuario, setUsuario] = useState(null);
  const [resultado, setResultado] = useState(null);

  const handleLogout = () => {
    setUsuario(null);
    setPantalla("login");
  };

  if (pantalla === "registro")
    return <Registro onVolver={() => setPantalla("login")} />;
  if (pantalla === "juego")
    return (
      <Juego
        usuario={usuario}
        onTerminar={(resultado) => {
          setResultado(resultado);
          setPantalla("resultado");
        }}
        onLogout={handleLogout}
      />
    );
  if (pantalla === "resultado")
    return (
      <Resultado
        resultado={resultado}
        onNuevaPartida={() => setPantalla("juego")}
        onLogout={handleLogout}
      />
    );

  return (
    <Login
      onLogin={(u) => {
        setUsuario(u);
        setPantalla("juego");
      }}
      onRegistro={() => setPantalla("registro")}
    />
  );
}

export default App;
