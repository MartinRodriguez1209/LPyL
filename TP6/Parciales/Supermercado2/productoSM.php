<?php
class ProductoSM
{
    public function __construct(){}

    public static function getProductosBD($producto,$ubicacion,$filtro)
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $productos = [];
        $query = "SELECT pre.*,p.nombre as nombreProdu,s.nombre as nombreSuper, s.ubicacion FROM precios as pre join producto as p ON p.id_producto=pre.id_producto JOIN supermercado as s ON s.id_supermercado=pre.id_supermercado ";
        switch ($filtro)
        {
            case 'nombre':
                $query.= "WHERE p.nombre LIKE '%{$producto}%' ";
                break;
            case 'ubicacion':
                $query.= "WHERE s.ubicacion LIKE '%{$ubicacion}%' ";
                break;
            case 'ambos':
                $query.= "WHERE p.nombre LIKE '%{$producto}%' AND s.ubicacion LIKE '%{$ubicacion}%'";
                break;
            case 'ninguno':
                //no hace nada
                break;
            default:
                break;
        }
        $query.= " ORDER BY precio ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $productos[] = $regi;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function getProductoInfoBD($nombre)
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $productos = [];
        $query = "SELECT pre.*,p.nombre as nombreProdu,s.nombre as nombreSuper, s.ubicacion FROM precios as pre join producto as p ON p.id_producto=pre.id_producto JOIN supermercado as s ON s.id_supermercado=pre.id_supermercado WHERE p.nombre LIKE '%{$nombre}%' ORDER BY precio ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $productos[] = $regi;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function getNombresProduBD()
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $productos = [];
        $query = "SELECT DISTINCT p.nombre FROM producto as p join precios as pre on p.id_producto=pre.id_producto ORDER BY p.nombre ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $productos[] = $regi;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function getUbicacionesBD()
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $ubicaciones = [];
        $query = "SELECT DISTINCT s.ubicacion FROM supermercado as s join precios as pre on s.id_supermercado=pre.id_supermercado ORDER BY s.nombre ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $ubicaciones[] = $regi;
        }
        $resu->free();
        $con->close();
        return $ubicaciones;
    }
}
?>