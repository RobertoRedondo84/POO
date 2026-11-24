<?php

declare(strict_types=1);

class Producto
{
    public function __construct(
        private string $nombre,
        private float $peso,
        private int $stock,
        private int $precio
    ) {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }

    public function __toString(): string
    {
        return "$this->nombre · $this->peso kg · Stock: $this->stock · " . euros($this->precio);
    }
}
