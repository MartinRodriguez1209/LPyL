<?php
require_once 'Db.php';

class Usuario implements JsonSerializable
{
    private String $nombreUsuario;
    private String $mail;

    private ?int $id;


    public function __construct($nombreUsuario, $mail, $id = null)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->mail = $mail;
        $this->id = $id;
    }

    public static function login($nombreUsuario, $password)
    {
        $conexion = conectar();
        $stmt = $conexion->prepare("SELECT id, nombre_usuario, mail, password FROM usuarios WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombreUsuario);
        try {
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            if ($resultado && password_verify($password, $resultado['password'])) {
                return ['ok' => true, 'user' => new Usuario($resultado['nombre_usuario'], $resultado['mail'], $resultado['id'])];
            }
            return ['ok' => false, 'mensaje' => 'Usuario o contraseña incorrecta'];
        } catch (Throwable $th) {
            return ['ok' => false, 'mensaje' => 'Error en el servidor'];
        }
    }
    public static function registro($nombreUsuario, $mail, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $conexion = conectar();
        $stmt = $conexion->prepare("INSERT into usuarios (nombre_usuario, mail, password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $nombreUsuario, $mail, $hash);

        try {
            $stmt->execute();
            return ['ok' => true];
        } catch (Exception $e) {
            if (str_contains($e->getMessage(), 'mail')) {
                return ['ok' => false, 'mensaje' => "El mail ya está registrado"];
            }
            return ['ok' => false, 'mensaje' => "El nombre de usuario ya existe"];
        }
    }


    public function getId()
    {
        return $this->id;
    }

    public function jsonSerialize(): mixed
    {

        return [
            "id" => $this->id,
            "nombreUsuario" => $this->nombreUsuario,
            "mail" => $this->mail
        ];
    }
}
