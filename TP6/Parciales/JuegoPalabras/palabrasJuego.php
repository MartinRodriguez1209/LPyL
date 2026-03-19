<?php
class PalabrasJuego
{
    private $idPalabra;
    private $palabra;
    private $dificultadPalabra;
    private $acertada;

    public function __construct()
    {
    }
    public function getIdPalabra()
    {
        return $this->idPalabra;
    }

    public function setIdPalabra($idPalabra)
    {
        $this->idPalabra = $idPalabra;
    }

    public function getPalabra()
    {
        return $this->palabra;
    }

    public function setPalabra($palabra)
    {
        $this->palabra = $palabra;
    }

    public function getDificultadPalabra()
    {
        return $this->dificultadPalabra;
    }

    public function setDificultadPalabra($dificultadPalabra)
    {
        $this->dificultadPalabra = $dificultadPalabra;
    }

    public function getAcertada()
    {
        return $this->acertada;
    }

    public function setAcertada($acertada)
    {
        $this->acertada = $acertada;
    }

    public static function getPalabrasBD()
    {
        $con = new mysqli('localhost', 'root', '', 'juego_palabras_2024');
        $palabras = [];
        $query = "SELECT * FROM palabras ORDER BY idPalabra ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object()) {
            $palabra = new PalabrasJuego();
            $palabra->setIdPalabra($regi->idPalabra);
            $palabra->setPalabra($regi->palabra);
            $palabra->setDificultadPalabra($regi->dificultadPalabra);
            $palabra->setAcertada($regi->acertada);
            $palabras[] = $palabra;
        }
        $resu->free();
        $con->close();
        return $palabras;
    }

    public static function incrementaAcertadaBD($id)
    {
        $con = new mysqli('localhost', 'root', '', 'juego_palabras_2024');
        $query = "UPDATE palabras SET acertada = acertada + 1 WHERE idPalabra = ".$id;
        $resu = $con->query($query);
        $mensaje = null;
        if ($resu)
        {
            $mensaje = "Aciertos actualizados, filas afectadas: ".$con->affected_rows;
        } else {
            $mensaje = "No pudo realizarse la actualizacion";
        }
        $con->close();
        return $mensaje;
    }

    public static function getAcertadaBD($id)
    {
        $con = new mysqli('localhost', 'root', '', 'juego_palabras_2024');
        $query = "SELECT acertada FROM palabras WHERE idPalabra = ".$id;
        $resu = $con->query($query);
        $acertada = null;
        if ($regi = $resu->fetch_object())
        {
            $acertada = $regi->acertada;
        }
        $resu->free();
        $con->close();
        return $acertada;
    }
}
?>