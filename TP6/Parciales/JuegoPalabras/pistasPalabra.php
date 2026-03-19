<?php
class PistasPalabra
{
    private $idPista;
    private $ordenPista;
    private $pista;

    public function __construct(){}
    public function getIdPista()
    {
        return $this->idPista;
    }

    public function setIdPista($idPista)
    {
        $this->idPista = $idPista;
    }

    public function getOrdenPista()
    {
        return $this->ordenPista;
    }

    public function setOrdenPista($ordenPista)
    {
        $this->ordenPista = $ordenPista;
    }

    public function getPista()
    {
        return $this->pista;
    }

    public function setPista($pista)
    {
        $this->pista = $pista;
    }

    public static function getPistasBD($id)
    {
        $con = new mysqli('localhost', 'root', '', 'juego_palabras_2024');
        $pistas = [];
        $query = "SELECT * FROM pistas WHERE idPalabra = ".$id." ORDER BY ordenPista ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object()) {
            $pista = new PistasPalabra();
            $pista->setIdPista($regi->idpista);
            $pista->setOrdenPista($regi->ordenPista);
            $pista->setPista($regi->pista);
            $pistas[] = $pista;
        }
        $resu->free();
        $con->close();
        return $pistas;
    }
}
?>