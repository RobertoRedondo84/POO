<?php

class Armor
{
    private string $name;
    private int $defense;

    public function __construct(string $name, int $defense)
    {
        $this->name = $name;
        $this->defense = $defense;
    }

    // Devuelve la defensa que aporta la armadura.
    public function getDefense(): int
    {
        return $this->defense;
    }

    public function __toString(): string
    {
        return "{$this->name} (Defensa: {$this->defense})";
    }
}