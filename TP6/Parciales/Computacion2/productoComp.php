<?php

class ProductoComp{

    public static function getProductosBD($filtro)
    {
        $con = new mysqli('localhost', 'root', '', 'computacion');
        $productos = [];
        $query = "SELECT DISTINCT nombreProducto FROM producto ";
        if ($filtro !== null)
        {
            $query .= "WHERE nombreProducto LIKE '%".$filtro."%' ";
        }
        $query.="ORDER BY nombreProducto ASC";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $productos[] = $regi;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function getDetallesProduBD($nombre)
    {
        $con = new mysqli('localhost', 'root', '', 'computacion');
        $productos = [];
        $query = "SELECT p.*,s.sucursal,s.cantidad,s.fechaAlta FROM producto as p join stockproducto as s on p.codigo = s.codigo WHERE nombreProducto LIKE '%{$nombre}%' ";
        $resu = $con->query($query);
        while ($regi = $resu->fetch_object())
        {
            $productos[] = $regi;
        }
        $resu->free();
        $con->close();
        return $productos;
    }

    public static function actualizaStock($cantidad,$codigo,$sucursal)
    {
        $con = new mysqli('localhost', 'root', '', 'computacion');
        $query = "UPDATE stockproducto SET cantidad = cantidad + {$cantidad} WHERE codigo = {$codigo} AND sucursal LIKE '%{$sucursal}%'";
        $resu = $con->query($query);
        $mensaje = null;
        if ($resu)
        {
            $mensaje = "Filas modificadas: {$con->affected_rows}";
        }
        else {
            $mensaje = "Error al actualizar";
        }
        $con->close();
        return $mensaje;
    }

}
?>