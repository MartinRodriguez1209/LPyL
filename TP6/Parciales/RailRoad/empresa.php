<?php
class Empresa
{
    private $idEmpresa;
    private $nombreEmpresa;
    private $paisEmpresa;
    private $webEmpresa;
    private $logoEmpresa;

    private $cantidadServicios;

    public function __construct(){}
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }
    public function getPaisEmpresa()
    {
        return $this->paisEmpresa;
    }
    public function getWebEmpresa()
    {
        return $this->webEmpresa;
    }
    public function getLogoEmpresa()
    {
        return $this->logoEmpresa;
    }

    // --- Setters (Métodos para establecer/modificar los valores de las propiedades) ---
    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;
    }
    public function setPaisEmpresa($paisEmpresa)
    {
        $this->paisEmpresa = $paisEmpresa;
    }
    public function setWebEmpresa($webEmpresa)
    {
        $this->webEmpresa = $webEmpresa;
    }
    public function setLogoEmpresa($logoEmpresa)
    {
        $this->logoEmpresa = $logoEmpresa;
    }

    public function setCantidadServicios($cantidad)
    {
        $this->cantidadServicios = $cantidad;
    }

    public function getCantidadServicios()
    {
        return $this->cantidadServicios;
    }

    public static function getEmpresasBD()
    {
        $con = new mysqli('localhost', 'root', '', 'raileurope');
        $empresas = [];
        $query = "SELECT e.*, count(s.idServicio) as cantidadServicios FROM empresas as e JOIN servicios as s ON e.idEmpresa = s.idEmpresa GROUP BY e.idEmpresa ORDER BY e.idEmpresa";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $empresa = new Empresa();
            $empresa->setIdEmpresa($regi->idEmpresa);
            $empresa->setNombreEmpresa($regi->nombreEmpresa);
            $empresa->setPaisEmpresa($regi->paisEmpresa);
            $empresa->setWebEmpresa($regi->webEmpresa);
            $empresa->setLogoEmpresa($regi->logoEmpresa);
            $empresa->setCantidadServicios($regi->cantidadServicios);
            $empresas[] = $empresa;
        }
        $resu->free();
        $con->close();
        return $empresas;
    }

    public static function getEmpresasFiltradasBD($origen,$destino,$ubicacion)
    {
        $con = new mysqli('localhost', 'root', '', 'raileurope');
        $empresas = [];
        $query = "SELECT e.*, count(s.idServicio) as cantidadServicios FROM empresas as e JOIN servicios as s ON e.idEmpresa = s.idEmpresa ";
        switch ($ubicacion){
            case 'Origen':
                $query .= "WHERE ciudadOrigenServicio = '".$origen."' ";
                break;
            case 'Destino':
                $query .= "WHERE ciudadDestinoServicio = '".$destino."' ";
                break;
            case 'Ambas':
                $query .= "WHERE ciudadOrigenServicio = '".$origen."' AND ciudadDestinoServicio = '".$destino."' ";
                break;
            case 'Ninguno':
                break;
            default:
                break;
        }
        $query .= "GROUP BY e.idEmpresa ORDER BY e.idEmpresa";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $empresa = new Empresa();
            $empresa->setIdEmpresa($regi->idEmpresa);
            $empresa->setNombreEmpresa($regi->nombreEmpresa);
            $empresa->setPaisEmpresa($regi->paisEmpresa);
            $empresa->setWebEmpresa($regi->webEmpresa);
            $empresa->setLogoEmpresa($regi->logoEmpresa);
            $empresa->setCantidadServicios($regi->cantidadServicios);
            $empresas[] = $empresa;
        }
        $resu->free();
        $con->close();
        return $empresas;
    }    

    public static function getEmpresaBD($idEmpresa)
    {
        $con = new mysqli('localhost', 'root', '', 'raileurope');
        $empresa = NULL;
        $query = "SELECT * FROM empresas WHERE idEmpresa = ". $idEmpresa;
        $resu = $con->query($query);
        if ($regi = $resu->fetch_object())
        {
            $empresa = new Empresa();
            $empresa->setIdEmpresa($regi->idEmpresa);
            $empresa->setNombreEmpresa($regi->nombreEmpresa);
            $empresa->setPaisEmpresa($regi->paisEmpresa);
            $empresa->setWebEmpresa($regi->webEmpresa);
            $empresa->setLogoEmpresa($regi->logoEmpresa);
            $empresa->setCantidadServicios(NULL);
        }
        $resu->free();
        $con->close();
        return $empresa;
    }
    
}
?>