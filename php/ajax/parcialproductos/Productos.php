<?php
class Producto implements JsonSerializable
{
    private String $nombreProducto;
    private int $totalStock;
    private int $precio;
    private String $proveedor;
    private $stockSucursal = [];
    private int $codigoProducto;

    public function __construct($nombreProducto, $totalStock, $precio, $proveedor, $stockSucursal, $codigoProducto)
    {
        $this->nombreProducto = $nombreProducto;
        $this->totalStock = $totalStock;
        $this->precio = $precio;
        $this->proveedor = $proveedor;
        $this->stockSucursal = $stockSucursal;
        $this->codigoProducto = $codigoProducto;
    }

    /**
     * Get the value of nombreProducto
     */
    public function getNombreProducto(): String
    {
        return $this->nombreProducto;
    }

    /**
     * Get the value of totalStock
     */
    public function getTotalStock(): int
    {
        return $this->totalStock;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio(): int
    {
        return $this->precio;
    }

    /**
     * Get the value of proveedor
     */
    public function getProveedor(): String
    {
        return $this->proveedor;
    }

    /**
     * Get the value of stockSucursal
     */
    public function getStockSucursal()
    {
        return $this->stockSucursal;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "codigoProducto" => $this->codigoProducto,
            "nombreProducto" => $this->nombreProducto,
            "totalStock"     => $this->totalStock,
            "precio"         => $this->precio,
            "proveedor"      => $this->proveedor,
            "stockSucursal"  => $this->stockSucursal,
        ];
    }
}
