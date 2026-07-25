import { useState } from "react";
import { Button, Input } from "./ui";
import PatronLetras from "./PatronLetras";

import { loginApi } from "../../api/auth";

function Login({ onRegistro, onLogin }) {
  const [usuario, setUsuario] = useState(
    localStorage.getItem("usuarioGuardado") || "",
  );
  const [password, setPassword] = useState("");
  const [recordarUsuario, setRecordarUsuario] = useState(
    Boolean(localStorage.getItem("usuarioGuardado")),
  );
  const [error, setError] = useState("");
  const handleLogin = async (e) => {
    e.preventDefault();
    const data = await loginApi(usuario, password);
    if (data.ok) {
      onLogin(data.user);
      if (recordarUsuario) {
        localStorage.setItem("usuarioGuardado", usuario);
      } else {
        localStorage.removeItem("usuarioGuardado");
      }
    } else setError(data.mensaje);
  };

  return (
    <div className="min-h-screen relative overflow-hidden flex items-center justify-center gap-16 bg-gray-100">
      <PatronLetras />
      <div className="relative max-w-2xl text-center">
        <h1 className="text-8xl font-extrabold tracking-tight bg-linear-to-r from-blue-600 to-black bg-clip-text text-transparent">
          Adivine la Palabra
        </h1>
        <p className="text-gray-800 mt-2 text-2xl">
          Adiviná la palabra letra por letra antes de quedarte sin intentos
        </p>
      </div>

      <div className="relative bg-white rounded-xl shadow-md p-8 w-full max-w-sm">
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
          <label className="mb-2 text-sm font-medium text-gray-900">
            <input
              type="checkbox"
              checked={recordarUsuario}
              onChange={() => setRecordarUsuario(!recordarUsuario)}
            />{" "}
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
