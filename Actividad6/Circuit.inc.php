<?php

declare(strict_types=1);

class Circuit
{
    public function __construct(
        private string $name,
        private string $country,
        private int $laps,
        private string $localidad,
        private float $kilometros,
        private int $curvasIzq,
        private int $curvasDer
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getLaps(): int
    {
        return $this->laps;
    }

    public function setLaps(int $laps): void
    {
        $this->laps = $laps;
    }

    public function getLocalidad(): string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): void
    {
        $this->localidad = $localidad;
    }

    public function getKilometros(): float
    {
        return $this->kilometros;
    }

    public function setKilometros(float $kilometros): void
    {
        $this->kilometros = $kilometros;
    }

    public function getCurvasIzq(): int
    {
        return $this->curvasIzq;
    }

    public function setCurvasIzq(int $curvasIzq): void
    {
        $this->curvasIzq = $curvasIzq;
    }

    public function getCurvasDer(): int
    {
        return $this->curvasDer;
    }

    public function setCurvasDer(int $curvasDer): void
    {
        $this->curvasDer = $curvasDer;
    }

    public function __toString(): string
    {
        return "$this->name · $this->localidad ($this->country) · $this->laps vueltas · "
            . number_format($this->kilometros, 3, ',', '.') . ' km por vuelta · '
            . "$this->curvasIzq curvas a la izquierda y $this->curvasDer a la derecha";
    }
}
