<?php

declare(strict_types=1);

class LineaPedido
{
    public function __construct(
        private Producto $producto,
        private int $cantidad,
        private int $precio
    ) {
    }

    public function getProducto(): Producto
    {
        return $this->producto;
    }

    public function setProducto(Producto $producto): void
    {
        $this->producto = $producto;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }

    public function calcularSubtotal(): int
    {
        return $this->cantidad * $this->precio;
    }

    public function __toString(): string
    {
        return $this->producto->getNombre() . " × $this->cantidad a " . euros($this->precio)
            . " = " . euros($this->calcularSubtotal());
    }
}
