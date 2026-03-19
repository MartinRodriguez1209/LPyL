<?php
include 'modelo.php';
include 'avion.php';
$json = NULL;
if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action){
        case 'modelo':
            if (isset($_POST['modelos'])){
                $modelos = modelo::getModelosBD($_POST['modelos']);
                if (is_null($modelos)){
                    $obj = new stdClass();
                    $obj->nombre = 'Vacio';
                }else{
                    $obj = new stdClass();
                    $obj->nombre = 'Lleno';
                    $obj->modelos = [];
                    for($i=0;$i<count($modelos);$i++)
                    {
                        $modelo = new stdClass();
                        $modelo->id_modelo = $modelos[$i]->getIdModelo();
                        $modelo->nombre_modelo = $modelos[$i]->getNombreReducido();
                        $obj->modelos[] = $modelo;
                    }
                }
                $json = json_encode($obj);
            }
            break;
        case 'aviones':
            if (isset($_POST['modelo'])){
                $modelo = modelo::getModeloBD($_POST['modelo']);
                if(!is_null($modelo))
                {
                $aviones = avion::getAvionesBD($modelo->getIdModelo());
                if (is_null($aviones)){

                } else {
                    $obj = new stdClass();
                    $obj->nombre = 'Lleno';
                    $obj->nombreCompleto = $modelo->getNombre();
                    $obj->fabricante = $modelo->getFabricante();
                    $obj->aviones = [];
                    for ($i=0;$i<count($aviones);$i++)
                    {
                        $avion = new stdClass();
                        $avion->matricula = $aviones[$i]->getMatricula();
                        $avion->fechaflota = $aviones[$i]->getFechaIngreso();
                        $avion->capacidad = $aviones[$i]->getCapacidad();
                        $avion->distribucion = $aviones[$i]->getDistribucion();
                        $obj->aviones[] = $avion;
                    }
                }
                
            } else {
                $obj = new stdClass();
                $obj->nombre = 'Vacio';
            }
            $json = json_encode($obj);
        }
            break;
        default:
        break;
    }
}
echo $json;

?>