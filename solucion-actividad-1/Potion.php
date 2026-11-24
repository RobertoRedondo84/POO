<?php

class Potion
{
    private string $name;
    private int $healing;

    public function __construct(string $name, int $healing)
    {
        $this->name = $name;
        $this->healing = $healing;
    }

    // Devuelve los puntos de vida que recupera la poción.
    public function getHealing(): int
    {
        return $this->healing;
    }

    public function __toString(): string
    {
        return "{$this->name} (Curación: {$this->healing})";
    }
}