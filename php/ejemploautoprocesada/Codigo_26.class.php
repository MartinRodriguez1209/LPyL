<?php
//Codigo_26.class.php
class archivo
{
	private $nombre;
	private $tipo;
	private $tamanio;
	private $nombre_temporal;
	
	public function __construct($PNombre)
	{	$this->nombre = $PNombre;	}
	
	public function getNombre()
	{	return $this->nombre;		}
	
	public function setNombre($PNombre)
	{	$this->nombre = $PNombre;	}
	
	public function getTipo()
	{	return $this->tipo;			}
	
	public function setTipo($PTipo)
	{	$this->tipo = $PTipo;		}

	public function getTamanio()
	{	return $this->tamanio;			}
	
	public function setTamanio($PTamanio)
	{	$this->tamanio = $PTamanio;		}

	public function getNombreTemporal()
	{	return $this->nombre_temporal;		}
	
	public function setNombreTemporal($PNombreTemp)
	{	$this->nombre_temporal = $PNombreTemp;	}
	
	public function moverArchivo($PDestino)
	{	return move_uploaded_file($this->getNombreTemporal(),$PDestino);	}
}
?>