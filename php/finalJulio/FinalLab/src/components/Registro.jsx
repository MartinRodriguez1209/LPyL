import { use, useState } from "react";
import { Button, Input } from "./ui";

function Registro({ onVolver }) {
  const [usuario, setUsuario] = useState("");
  const [password, setPassword] = useState("");
  const [mail, setMail] = useState("");
  const [passwordConfirm, setPasswordConfirm] = useState("");
  const [error, setError] = useState("");

  function handleSubmit(e) {
    e.preventDefault();
    if (password !== passwordConfirm) {
      setError("Las contraseñas no conciden!");
      return;
    }
    setError("");
    console.log(usuario, mail, password);
  }

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <div className="bg-white rounded-xl shadow-md p-8 w-full max-w-sm">
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
          <Button
            type="button"
            onClick={onVolver}
            className="text-sm text-blue-600 mt-3"
          >
            ¿Ya tienes cuenta? Inicia sesion
          </Button>
        </form>
      </div>
    </div>
  );
}

export default Registro;
