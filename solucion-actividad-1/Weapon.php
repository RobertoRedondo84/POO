<?php

class Weapon
{
    private string $name;
    private int $attack;

    public function __construct(string $name, int $attack)
    {
        $this->name = $name;
        $this->attack = $attack;
    }

    // Permite a Hero consultar el ataque de un arma equipada.
    public function getAttack(): int
    {
        return $this->attack;
    }

    public function __toString(): string
    {
        return "{$this->name} (Ataque: {$this->attack})";
    }
}