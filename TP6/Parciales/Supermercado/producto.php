<?php
class Producto
{
    private $idProducto;
    private $nombreProducto;
    private $precio;
    private $idSupermercado;
    private $nombreSupermercado;
    private $ubicacion;

    public function __construct(){}
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getIdSupermercado()
    {
        return $this->idSupermercado;
    }

    public function setIdSupermercado($idSupermercado)
    {
        $this->idSupermercado = $idSupermercado;
    }

    public function getNombreSupermercado()
    {
        return $this->nombreSupermercado;
    }

    public function setNombreSupermercado($nombreSupermercado)
    {
        $this->nombreSupermercado = $nombreSupermercado;
    }

    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }    

    public static function getNombresProductoBD()
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $nombres = [];
        $query = "SELECT DISTINCT nombre FROM producto ORDER BY nombre ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $nombres[] = $regi->nombre;
        }
        $resu->free();
        $con->close();
        return $nombres; 
    }

    public static function getUbicacionesBD()
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $ubicaciones = [];
        $query = "SELECT DISTINCT ubicacion FROM supermercado ORDER BY ubicacion ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $ubicaciones[] = $regi->ubicacion;
        }
        $resu->free();
        $con->close();
        return $ubicaciones; 
    }

    public static function getProductosFiltradosBD($nombreProducto,$ubicacion,$TipoFiltro)
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $productos = [];
        $query = "SELECT pre.*,p.nombre as nombreProdu,s.nombre as nombreSuper,s.ubicacion as ubi FROM precios as pre JOIN producto as p ON p.id_producto=pre.id_producto JOIN supermercado as s on s.id_supermercado=pre.id_supermercado ";
        switch ($TipoFiltro){
            case 'Producto':
                $query .= "WHERE p.nombre LIKE '%".$nombreProducto."%' ";
                break;
            case 'Ubicacion':
                $query .= "WHERE s.ubicacion LIKE '%".$ubicacion."%'";
                break;
            case 'Ambas':
                $query .= "WHERE p.nombre LIKE '%".$nombreProducto."%' AND s.ubicacion LIKE '%".$ubicacion."%' ";
                break;
            case 'Ninguno':
                break;
            default:
                break;
        }
        $query.= "ORDER BY precio ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $producto = new Producto();
            $producto->setIdproducto($regi->id_producto);
            $producto->setNombreProducto($regi->nombreProdu);
            $producto->setPrecio($regi->precio);
            $producto->setIdSupermercado($regi->id_supermercado);
            $producto->setNombreSupermercado($regi->nombreSuper);
            $producto->setUbicacion($regi->ubi);
            $productos[] = $producto;

        }
        $resu->free();
        $con->close();
        return $productos;
    }    

    public static function getProductoBD($nombreProducto)
    {
        $con = new mysqli('localhost', 'root', '', 'comparador');
        $productos = [];
        $query = "SELECT pre.*,p.nombre as nombreProdu,s.nombre as nombreSuper,s.ubicacion as ubi FROM precios as pre JOIN producto as p ON p.id_producto=pre.id_producto JOIN supermercado as s on s.id_supermercado=pre.id_supermercado WHERE p.nombre = '".$nombreProducto."' ORDER BY precio ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $producto = new Producto();
            $producto->setIdproducto($regi->id_producto);
            $producto->setNombreProducto($regi->nombreProdu);
            $producto->setPrecio($regi->precio);
            $producto->setIdSupermercado($regi->id_supermercado);
            $producto->setNombreSupermercado($regi->nombreSuper);
            $producto->setUbicacion($regi->ubi);
            $productos[] = $producto;

        }
        $resu->free();
        $con->close();
        return $productos;
    }
}
?>