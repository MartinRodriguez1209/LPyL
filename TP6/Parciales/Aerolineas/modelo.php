<?php
class Modelo{

    private $id_modelo;
    private $nombre;
    private $nombreReducido;
    private $fabricante;

    public function __construct(){}

    public function getIdModelo()
    {
        return $this->id_modelo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getNombreReducido()
    {
        return $this->nombreReducido;
    }
    public function getFabricante()
    {
        return $this->fabricante;
    }
    public function setIdModelo($id_modelo)
    {
        $this->id_modelo = $id_modelo;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setNombreReducido($nombreReducido)
    {
        $this->nombreReducido = $nombreReducido;
    }
    public function setFabricante($fabricante)
    {
        $this->fabricante = $fabricante;
    }

    public static function getModeloBD($nombre)
    {
        $con = new mysqli('localhost', 'root', '', 'aerolineas');
        $modelo = NULL;
        $query = "SELECT * FROM modelos WHERE nombreReducido = '".$nombre."'";
        $resu = $con->query($query);
        if ($regi = $resu->fetch_object()) {
            $modelo = new Modelo();
            $modelo->setIdModelo($regi->idModelo);
            $modelo->setNombre($regi->nombre);
            $modelo->setNombreReducido($regi->nombreReducido);
            $modelo->setFabricante($regi->fabricante);
        }
        $resu->free();
        $con->close();
        return $modelo;
    }

    public static function getModelosBD($nombre)
    {
        $con = new mysqli('localhost', 'root', '', 'aerolineas');
        $modelos = [];
        $query = "SELECT * FROM modelos WHERE nombreReducido LIKE '%".$nombre."%'";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object()) {
            $modelo = new Modelo();
            $modelo->setIdModelo($regi->idModelo);
            $modelo->setNombre($regi->nombre);
            $modelo->setNombreReducido($regi->nombreReducido);
            $modelo->setFabricante($regi->fabricante);
            $modelos[] = $modelo;
        }
        $resu->free();
        $con->close();
        return $modelos;
    }
}
?>