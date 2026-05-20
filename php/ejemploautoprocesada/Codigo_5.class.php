<?php
//Codigo_5.class.php
class persona
{
	private $nombre;
	private $edad;
	
	public function __construct($PNombre, $PEdad)
	{	$this->nombre = $PNombre;
		$this->edad = $PEdad;		}
	
	public function getNombre()
	{	return $this->nombre;		}
	
	public function setNombre($PNombre)
	{	$this->nombre = $PNombre;	}
	
	public function getEdad()
	{	return $this->edad;			}
	
	public function setEdad($PEdad)
	{	$this->edad = $PEdad;		}
	
	public function getDiasVividos()
	{	define("cantiDiasAnio", 365);
		return $this->getEdad()*cantiDiasAnio;	}
}
?>