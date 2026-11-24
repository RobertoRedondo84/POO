<?php

declare(strict_types=1);

class Cliente
{
    public function __construct(
        private string $nombre,
        private string $direccion
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

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function __toString(): string
    {
        return "$this->nombre · $this->direccion";
    }
}
