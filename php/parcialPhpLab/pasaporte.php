<?php

class Pasaporte
{
    private $nombre;
    private $apellido;
    private $dni;
    private $fechaNacimiento;
    private $genero;
    private $paisOrigen;
    private $codigoVerificador;
    private $renueva;
    private $fechaAlta;

    public function __construct($nombre, $apellido, $dni, $fechaNacimiento, $genero, $paiseOrigen, $renueva)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->genero = $genero;
        $this->paisOrigen = $paiseOrigen;
        $this->codigoVerificador = $this->generarCodigoVerificador($dni, $fechaNacimiento);
        $this->renueva = $renueva;
        $this->fechaAlta = date("Y-m-d");
    }


    private function generarCodigoVerificador($dni, $fecha)
    {
        $fechaSeparada = explode("-", $fecha);
        $anio = $fechaSeparada[2];
        $codigo = $dni . $anio;

        $codigoVerificador = 0;
        foreach (str_split($codigo) as $valor) {
        }
        for ($i = 0; $i < count(str_split($codigo)); $i++) {
            $codigoVerificador = ($i + 1) * str_split($codigo)[$i];
        }
        return $codigoVerificador;
    }

    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    public function renueva()
    {
        return $this->renueva;
    }

    public function getNombreCompleto()
    {
        return $this->nombre . " " . $this->apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }
    public function getDni()
    {
        return $this->dni;
    }
    public function getFechaNac()
    {
        return $this->fechaNacimiento;
    }
    public function getGenero()
    {
        return $this->genero;
    }
    public function getPais()
    {
        return $this->paisOrigen;
    }
    public function getCodigoVer()
    {
        return $this->codigoVerificador;
    }
}
