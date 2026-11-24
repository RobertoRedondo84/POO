<?php

declare(strict_types=1);

class Cheque extends Pago
{
    public function __construct(
        int $importe,
        private string $nombre,
        private string $banco
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

    public function getBanco(): string
    {
        return $this->banco;
    }

    public function setBanco(string $banco): void
    {
        $this->banco = $banco;
    }

    public function __toString(): string
    {
        return "Cheque de $this->nombre · $this->banco · " . parent::__toString();
    }
}
