<?php
class Avion
{
    private $id_avion;
    private $matricula;
    private $fechaIngreso;
    private $capacidad;
    private $distribucion;

    public function __construct(){}

    public function getIdAvion()
    {
        return $this->id_avion;
    }
    public function getMatricula()
    {
        return $this->matricula;
    }
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }
    public function getCapacidad()
    {
        return $this->capacidad;
    }
    public function getDistribucion()
    {
        return $this->distribucion;
    }
    public function setIdAvion($id_avion)
    {
        $this->id_avion = $id_avion;
    }
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    }
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;
    }
    public function setDistribucion($distribucion)
    {
        $this->distribucion = $distribucion;
    }
    public static function getAvionesBD($idModelo)
    {
        $con = new mysqli('localhost', 'root', '', 'aerolineas');
        $aviones = [];
        $query = "SELECT * FROM aviones WHERE idModelo = ".$idModelo;
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object()) {
            $avion = new Avion();
            $avion->setIdAvion($regi->idAvion);
            $avion->setMatricula($regi->matricula);
            $avion->setFechaIngreso($regi->fechaIngreso);
            $avion->setCapacidad($regi->capacidad);
            $avion->setDistribucion($regi->distribucion);
            $aviones[] = $avion;
        }
        $resu->free();
        $con->close();
        return $aviones;
    }
}
?>