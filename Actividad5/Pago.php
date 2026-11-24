<?php

declare(strict_types=1);

abstract class Pago
{
    public function __construct(
        protected int $importe
    ) {
    }

    public function getImporte(): int
    {
        return $this->importe;
    }

    public function setImporte(int $importe): void
    {
        $this->importe = $importe;
    }

    public function __toString(): string
    {
        return euros($this->importe);
    }
}
