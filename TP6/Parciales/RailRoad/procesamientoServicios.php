<?php
$json = "hola";
include 'empresa.php';
include 'servicios.php';

if (isset($_POST['action']) && isset($_POST['idEmpresa'])) {

    $servicios = null;
    $empresa = Empresa::getEmpresaBD($_POST['idEmpresa']);
    if (!is_null($empresa)) {

        $action = $_POST['action'];
        switch ($action) {

            case 'Ambos':
                if (isset($_POST['idOrigen']) && isset($_POST['idDestino'])) {
                    $servicios = Servicios::getServiciosEmpresaBD($empresa->getIdEmpresa(), $_POST['idOrigen'], $_POST['idDestino'], 'Ambas');
                }
                break;

            case 'Origen':
                if (isset($_POST['idOrigen'])) {
                    $servicios = Servicios::getServiciosEmpresaBD($empresa->getIdEmpresa(), $_POST['idOrigen'], null, 'Origen');
                }
                break;

            case 'Destino':
                if (isset($_POST['idDestino'])) {
                    $servicios = Servicios::getServiciosEmpresaBD($empresa->getIdEmpresa(), null, $_POST['idDestino'], 'Destino');
                }
                break;

            case 'Todo':
                if (isset($_POST['idNinguno'])) {
                    $servicios = Servicios::getServiciosEmpresaBD($empresa->getIdEmpresa(), null, null, 'Ninguno');
                }
                break;
            default:
                break;

        }

    }

    $obj = new stdClass();
    $obj->nombreEmpresa = $empresa->getNombreEmpresa();
    $obj->servicios = [];
    for ($i = 0; $i < count($servicios); $i++) {
        $servicio = new stdClass();
        $servicio->nroServicio = $servicios[$i]->getNroServicio();
        $servicio->estacionOrigen = $servicios[$i]->getEstacionOrigenServicio();
        $servicio->estacionDestino = $servicios[$i]->getEstacionDestinoServicio();
        $servicio->horaSalida = $servicios[$i]->getHoraSalidaServicio();
        $servicio->horaLlegada = $servicios[$i]->getHoraLlegadaServicio();
        $servicio->frecuencia = $servicios[$i]->getFrecuenciaServicio();
        $servicio->precio = $servicios[$i]->getPrecioServicio();
        $obj->servicios[] = $servicio;
    }
    $json = json_encode($obj);
}
echo $json;
?>