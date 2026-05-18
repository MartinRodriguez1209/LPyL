<?php
require_once 'Dado.php';
require_once 'Jugador.php';

class Partida
{
    private $jugador;
    private $jugadorCPU;
    private $jugadorActual;
    private $dado;
    private $turnoActual;
    private $ultimaTirada;
    private $terminada;

    public function __construct()
    {
        $this->jugador = new Jugador("martin");
        $this->jugadorCPU = new Jugador("cpu");
        $this->dado = new Dado();
        $this->turnoActual = 0;
        $this->terminada = false;
    }



    public function tiradaJugador()
    {
        $this->jugadorActual = $this->jugador;
        $this->ultimaTirada = $this->dado->tirarDado($this->jugador, $this->jugadorCPU);
        $this->turnoActual++;
    }
    public function tiradaCpu()
    {
        $this->jugadorActual = $this->jugadorCPU;
        $this->ultimaTirada = $this->dado->tirarDado($this->jugadorCPU, $this->jugador);
        $this->turnoActual++;
    }

    public function datosPartida()
    {
        return  [
            "turnoActual" => $this->turnoActual,
            "puntosJugador" => $this->jugador->getPuntaje(),
            "puntosCpu" => $this->jugadorCPU->getPuntaje(),
            "ultimaTirada" => $this->ultimaTirada,
            "terminada" => $this->terminada,
            "jugadorActual" => $this->jugadorActual
        ];
    }

    public function termino()
    {
        return $this->jugador->derrota() || $this->jugadorCPU->derrota();
    }
    public function ganador()
    {
        if ($this->jugador->derrota()) return "CPU";
        if ($this->jugadorCPU->derrota()) return "Jugador";
        return null;
    }
}
