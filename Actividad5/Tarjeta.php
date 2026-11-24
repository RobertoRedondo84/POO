<?php

declare(strict_types=1);

class Tarjeta extends Pago
{
    public function __construct(
        int $importe,
        private string $numero,
        private string $caducidad
    ) {
        parent::__construct($importe);
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function getCaducidad(): string
    {
        return $this->caducidad;
    }

    public function setCaducidad(string $caducidad): void
    {
        $this->caducidad = $caducidad;
    }

    public function __toString(): string
    {
        return "Tarjeta terminada en " . substr($this->numero, -4)
            . " · Caducidad $this->caducidad · " . parent::__toString();
    }
}
