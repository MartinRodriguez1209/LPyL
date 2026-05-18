<?php
require_once 'Jugador.php';

class Dado
{

    private $efectosTirador = [
        1 => 6,
        2 => 0,
        3 => -2,
        4 => 4,
        5 => -3,
        6 => 1
    ];

    private $efectosOponente = [
        1 => -6,
        2 => 0,
        3 => 4,
        4 => -2,
        5 => -3,
        6 => -3
    ];

    public function tirarDado(Jugador $tiradorDado, Jugador $oponente)
    {
        $numeroDado = random_int(1, 6);

        $tiradorDado->aplicarPuntos($this->efectosTirador[$numeroDado]);
        $oponente->aplicarPuntos($this->efectosOponente[$numeroDado]);
        return $numeroDado;
    }
}
