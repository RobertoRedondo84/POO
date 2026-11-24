<?php

declare(strict_types=1);

class Efectivo extends Pago
{
    public function __construct(
        int $importe,
        private string $nombre
    ) {
        parent::__construct($importe);
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function __toString(): string
    {
        return "Efectivo · $this->nombre · " . parent::__toString();
    }
}
