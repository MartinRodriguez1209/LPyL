<?php class Jugador
{
    private $puntaje = 20;
    private string $nombre;


    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }
    public function aplicarPuntos($puntos)
    {
        $this->puntaje += $puntos;
    }
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    public function __toString()
    {
        return $this->nombre;
    }


    public function derrota()
    {
        return $this->puntaje <= 0;
    }
}
