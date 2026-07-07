import { useState } from "react";
import { Button, Input } from "./ui";

import { loginApi } from "../../api/auth";

function Login({ onRegistro, onLogin }) {
  const [usuario, setUsuario] = useState("");
  const [password, setPassword] = useState("");
  const [recordarUsuario, setRecordarUsuario] = useState(false);
  const [error, setError] = useState("");
  const handleLogin = async (e) => {
    e.preventDefault();
    const data = await loginApi(usuario, password);
    if (data.ok) onLogin(data.user);
    else setError(data.mensaje);
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <div className="bg-white rounded-xl shadow-md p-8 w-full max-w-sm">
        <h2 className="text-xl font-bold">Login</h2>
        <form onSubmit={handleLogin}>
          <label className="block mb-2 text-sm font-medium text-gray-900">
            Ingrese su usuario{" "}
            <Input
              required
              placeholder="MiUsuario"
              value={usuario}
              onChange={(e) => setUsuario(e.target.value)}
            />
          </label>
          <label className="block mb-2 text-sm font-medium text-gray-900">
            Ingrese su contraseña
            <Input
              type="password"
              required
              value={password}
              placeholder="*********"
              onChange={(e) => setPassword(e.target.value)}
            />
          </label>
          <input
            type="checkbox"
            checked={recordarUsuario}
            onChange={() => setRecordarUsuario(!recordarUsuario)}
          />
          <label className=" mb-2 text-sm font-medium text-gray-900">
            {" "}
            Recordar mi usuario
          </label>
          <Button type="submit">Iniciar sesion</Button>
          {error && <p className="text-red-500 text-sm mt-2">{error}</p>}
          <button
            type="button"
            onClick={onRegistro}
            className="text-sm text-blue-600 mt-3 hover:underline"
          >
            ¿No tenés cuenta? Registrate
          </button>
        </form>
      </div>
    </div>
  );
}

export default Login;
