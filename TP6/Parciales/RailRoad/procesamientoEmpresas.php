<?php
$json = "hola";
include 'empresa.php';

if (isset($_POST['action'])) {

    $action = $_POST['action'];
    $empresas = null;

        $action = $_POST['action'];
        switch ($action) {

            case 'Ambos':
                if (isset($_POST['idOrigen']) && isset($_POST['idDestino'])) {
                    $empresas = Empresa::getEmpresasFiltradasBD($_POST['idOrigen'],$_POST['idDestino'],'Ambas');
                }
                break;

            case 'Origen':
                if (isset($_POST['idOrigen'])) {
                    $empresas = Empresa::getEmpresasFiltradasBD($_POST['idOrigen'],null,'Origen');
                }
                break;

            case 'Destino':
                if (isset($_POST['idDestino'])) {
                    $empresas = Empresa::getEmpresasFiltradasBD(null,$_POST['idDestino'],'Destino');
                }
                break;

            case 'Todo':
                if (isset($_POST['idNinguno'])) {
                    $empresas = Empresa::getEmpresasBD();
                }
                break;
            default:
                break;


    }

    $obj = new stdClass();
    $obj->empresas = [];
    for ($i = 0; $i < count($empresas); $i++) {
        $empresa= new stdClass();
        $empresa->idEmpresa = $empresas[$i]->getIdEmpresa();
        $empresa->nombreEmpresa = $empresas[$i]->getNombreEmpresa();
        $empresa->paisEmpresa = $empresas[$i]->getPaisEmpresa();
        $empresa->webEmpresa = $empresas[$i]->getWebEmpresa();
        $empresa->logoEmpresa = $empresas[$i]->getLogoEmpresa();
        $empresa->cantidadServicios = $empresas[$i]->getCantidadServicios();
        $obj->empresas[] = $empresa;
    }
    $json = json_encode($obj);
}
echo $json;
?>