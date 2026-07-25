import { useState } from "react";
import { Button, Input } from "./ui";
import { registroApi } from "../../api/auth";
import PatronLetras from "./PatronLetras";

function Registro({ onVolver }) {
  const [usuario, setUsuario] = useState("");
  const [password, setPassword] = useState("");
  const [mail, setMail] = useState("");
  const [passwordConfirm, setPasswordConfirm] = useState("");
  const [error, setError] = useState("");
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (password !== passwordConfirm) {
      setError("Las contraseñas no conciden!");
      return;
    }
    const data = await registroApi(usuario, mail, password);
    if (data.ok) onVolver();
    else setError(data.mensaje);
  };

  return (
    <div className="min-h-screen relative overflow-hidden flex items-center justify-center bg-gray-100">
      <PatronLetras />
      <div className="relative bg-white rounded-xl shadow-md p-8 w-full max-w-sm">
        <h2 className="text-xl font-bold">Crear cuenta</h2>
        <form onSubmit={handleSubmit}>
          <label className="block mb-2 text-sm font-medium text-gray-900">
            Ingrese su mail{" "}
            <Input
              required
              placeholder="MiMail"
              value={mail}
              type="email"
              onChange={(e) => setMail(e.target.value)}
            />
          </label>
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
          <label className="block mb-2 text-sm font-medium text-gray-900">
            Confirme su contraseña
            <Input
              type="password"
              required
              value={passwordConfirm}
              placeholder="*********"
              onChange={(e) => setPasswordConfirm(e.target.value)}
            />
          </label>

          <Button type="submit">Crear cuenta</Button>
          {error && <p className="text-red-500 text-sm mt-2">{error}</p>}
          <button
            type="button"
            onClick={onVolver}
            className="text-sm text-blue-600 mt-3 hover:underline"
          >
            ¿Ya tienes cuenta? Inicia sesion
          </button>
        </form>
      </div>
    </div>
  );
}

export default Registro;
