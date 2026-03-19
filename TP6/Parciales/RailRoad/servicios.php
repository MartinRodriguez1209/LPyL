<?php
class Servicios
{
    private $idServicio;
    private $nroServicio;
    private $ciudadOrigenServicio;
    private $ciudadDestinoServicio;
    private $estacionOrigenServicio;
    private $estacionDestinoServicio;
    private $horaSalidaServicio;
    private $horaLlegadaServicio;
    private $frecuenciaServicio;
    private $precioServicio;

    public function __construct(){}

    public function getIdServicio()
    {
        return $this->idServicio;
    }
    public function getNroServicio()
    {
        return $this->nroServicio;
    }
    public function getCiudadOrigenServicio()
    {
        return $this->ciudadOrigenServicio;
    }
    public function getCiudadDestinoServicio()
    {
        return $this->ciudadDestinoServicio;
    }
    public function getEstacionOrigenServicio()
    {
        return $this->estacionOrigenServicio;
    }
    public function getEstacionDestinoServicio()
    {
        return $this->estacionDestinoServicio;
    }
    public function getHoraSalidaServicio()
    {
        return $this->horaSalidaServicio;
    }
    public function getHoraLlegadaServicio()
    {
        return $this->horaLlegadaServicio;
    }
    public function getFrecuenciaServicio()
    {
        return $this->frecuenciaServicio;
    }
    public function getPrecioServicio()
    {
        return $this->precioServicio;
    }
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;
    }
    public function setNroServicio($nroServicio)
    {
        $this->nroServicio = $nroServicio;
    }
    public function setCiudadOrigenServicio($ciudadOrigenServicio)
    {
        $this->ciudadOrigenServicio = $ciudadOrigenServicio;
    }
    public function setCiudadDestinoServicio($ciudadDestinoServicio)
    {
        $this->ciudadDestinoServicio = $ciudadDestinoServicio;
    }
    public function setEstacionOrigenServicio($estacionOrigenServicio)
    {
        $this->estacionOrigenServicio = $estacionOrigenServicio;
    }
    public function setEstacionDestinoServicio($estacionDestinoServicio)
    {
        $this->estacionDestinoServicio = $estacionDestinoServicio;
    }
    public function setHoraSalidaServicio($horaSalidaServicio)
    {
        $this->horaSalidaServicio = $horaSalidaServicio;
    }
    public function setHoraLlegadaServicio($horaLlegadaServicio)
    {
        $this->horaLlegadaServicio = $horaLlegadaServicio;
    }
    public function setFrecuenciaServicio($frecuenciaServicio)
    {
        $this->frecuenciaServicio = $frecuenciaServicio;
    }
    public function setPrecioServicio($precioServicio)
    {
        $this->precioServicio = $precioServicio;
    }

    public static function getCiudadesBD()
    {
        $con = new mysqli('localhost', 'root', '', 'raileurope');
        $ciudades = [];
        $ciudades['ciudadOrigenServicio'] = [];
        $ciudades['ciudadDestinoServicio'] = [];
        $query = "SELECT DISTINCT ciudadOrigenServicio FROM servicios ORDER BY ciudadOrigenServicio";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $ciudades['ciudadOrigenServicio'][] = $regi->ciudadOrigenServicio;
        }
        $resu->free();
        $query = "SELECT DISTINCT ciudadDestinoServicio FROM servicios ORDER BY ciudadDestinoServicio";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $ciudades['ciudadDestinoServicio'][] = $regi->ciudadDestinoServicio;
        }
        $resu->free();
        $con->close();
        return $ciudades;
    }

    public static function getServiciosEmpresaBD($idEmpresa,$origen,$destino,$ubicacion)
    {
        $con = new mysqli('localhost', 'root', '', 'raileurope');
        $servicios = [];
        $query = "SELECT s.* FROM servicios as s JOIN empresas as e ON e.idEmpresa=s.idEmpresa WHERE e.idEmpresa = '".$idEmpresa."' ";
        switch ($ubicacion){
            case 'Origen':
                $query .= "AND ciudadOrigenServicio = '".$origen."' ";
                break;
            case 'Destino':
                $query .= "AND ciudadDestinoServicio = '".$destino."' ";
                break;
            case 'Ambas':
                $query .= "AND ciudadOrigenServicio = '".$origen."' AND ciudadDestinoServicio = '".$destino."' ";
                break;
            case 'Ninguno':
                break;
            default:
                break;
        }
        $query .= "ORDER BY s.idServicio";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $servicio = new Servicios();
            $servicio->setIdServicio($regi->idServicio);
            $servicio->setNroServicio($regi->nroServicio);
            $servicio->setEstacionOrigenServicio($regi->estacionOrigenServicio);
            $servicio->setEstacionDestinoServicio($regi->estacionDestinoServicio);
            $servicio->setHoraSalidaServicio($regi->horaSalidaServicio);
            $servicio->setHoraLlegadaServicio($regi->horaLlegadaServicio);
            $servicio->setFrecuenciaServicio($regi->frecuenciaServicio);
            $servicio->setPrecioServicio($regi->precioServicio);
            $servicios[] = $servicio;
        }
        $resu->free();
        $con->close();
        return $servicios;
    }

    

}
?>