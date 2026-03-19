<?php
class ProductoComputacion
{
    private $codigo;
    private $nombreProducto;
    private $precio;
    private $proveedor;
    private $sucursal;
    private $cantidad;
    private $fechaAlta;

    public function __construct(){}
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function getSucursal()
    {
        return $this->sucursal;
    }

    public function setSucursal($sucursal)
    {
        $this->sucursal = $sucursal;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }

    public static function getProductosBD($nombreProdu, $filtrado)
    {
        $con = new mysqli('localhost', 'root', '', 'computacion');
        $productos = [];
        $query = "SELECT DISTINCT nombreProducto FROM producto ";
        if ($filtrado === 'si')
        {
            $query .= "WHERE nombreProducto LIKE '%".$nombreProdu."%' ";
        }
        $query.="ORDER BY nombreProducto ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $producto = new ProductoComputacion();
            $producto->setNombreProducto($regi->nombreProducto);
            $productos[] = $producto;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function getProductosDetalleBD($nombre)
    {
        $con = new mysqli('localhost', 'root', '', 'computacion');
        $productos = [];
        $query = "SELECT p.*, s.sucursal, s.cantidad, s.fechaAlta FROM producto as p JOIN stockproducto as s ON p.codigo=s.codigo WHERE p.nombreProducto LIKE '%".$nombre."%'";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $producto = new ProductoComputacion();
            $producto->setCodigo($regi->codigo);
            $producto->setNombreProducto($regi->nombreProducto);
            $producto->setPrecio($regi->precio);
            $producto->setProveedor($regi->proveedor);
            $producto->setSucursal($regi->sucursal);
            $producto->setCantidad($regi->cantidad);
            $producto->setFechaAlta($regi->fechaAlta);
            $productos[] = $producto;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function actualizaStock($cantidad,$codigo,$sucursal)
    {
        $con = new mysqli('localhost', 'root', '', 'computacion');
        $producto = null;
        $query = "UPDATE stockproducto SET cantidad = cantidad + ".$cantidad." WHERE codigo = ".$codigo." AND sucursal LIKE '%".$sucursal."%' ";
        $resu = $con->query($query);
        $mensaje = null;
        if ($resu)
        {
            $mensaje = "Stock modificado, filas afectadas: ".$con->affected_rows;
        } else {
            $mensaje = "Error al modificar el stock";
        }
        $con->close();
        return $mensaje;
    }
}
?>