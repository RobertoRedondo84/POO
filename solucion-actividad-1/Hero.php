<?php

class Hero
{
    private string $name;
    private string $species;
    private string $class;
    private int $health;
    private int $baseAttack;
    private int $baseDefense;

    private array $weapons = [];
    private ?Armor $armor = null;
    private array $potions = [];

    public function __construct(
        string $name,
        string $species,
        string $class,
        int $health = 50,
        int $baseAttack = 10,
        int $baseDefense = 10
    ) {
        $this->name = $name;

        // Reutilizamos la validación del setter al crear el héroe.
        $this->__set('species', $species);
        $this->__set('class', $class);

        $this->health = $health;
        $this->baseAttack = $baseAttack;
        $this->baseDefense = $baseDefense;
    }

    // PHP llama a este método al leer una propiedad privada desde fuera de Hero.
    public function __get(string $property): mixed
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    // PHP llama a este método al asignar una propiedad privada desde fuera de Hero.
    public function __set(string $property, mixed $value): void
    {
        switch ($property) {
            case 'species':
                $this->species = is_string($value) && $this->checkSpecies($value)
                    ? $value
                    : 'humano';
                break;

            case 'class':
                $this->class = is_string($value) && $this->checkClass($value)
                    ? $value
                    : 'ninguna';
                break;

            case 'weapons':
                // El inventario admite hasta dos armas.
                if (!is_array($value) || count($value) > 2) {
                    throw new InvalidArgumentException('El héroe admite hasta dos armas.');
                }

                foreach ($value as $weapon) {
                    if (!$weapon instanceof Weapon) {
                        throw new InvalidArgumentException('Cada arma debe ser un objeto Weapon.');
                    }
                }

                $this->weapons = $value;
                break;

            case 'potions':
                // El inventario admite hasta tres pociones.
                if (!is_array($value) || count($value) > 3) {
                    throw new InvalidArgumentException('El héroe admite hasta tres pociones.');
                }

                foreach ($value as $potion) {
                    if (!$potion instanceof Potion) {
                        throw new InvalidArgumentException('Cada poción debe ser un objeto Potion.');
                    }
                }

                $this->potions = $value;
                break;

            default:
                if (property_exists($this, $property)) {
                    $this->$property = $value;
                }
        }
    }

    private function checkSpecies(string $species): bool
    {
        return in_array($species, ['humano', 'elfo', 'enano', 'orco'], true);
    }

    private function checkClass(string $class): bool
    {
        return in_array($class, ['guerrero', 'mago', 'arquero', 'ladrón'], true);
    }

    public function attack(): int
    {
        $totalAttack = $this->baseAttack;

        // Cada arma añade su ataque al ataque base del héroe.
        foreach ($this->weapons as $weapon) {
            $totalAttack += $weapon->getAttack();
        }

        return $totalAttack;
    }

    public function defense(int $damage): int
    {
        $totalDefense = $this->baseDefense;

        if ($this->armor !== null) {
            $totalDefense += $this->armor->getDefense();
        }

        // La defensa resultante tiene un mínimo de cero.
        return max(0, $totalDefense - $damage);
    }

    public function usePotion(): void
    {
        if ($this->potions === []) {
            return;
        }

        // Partimos de la primera clave real del array.
        $bestIndex = array_key_first($this->potions);

        foreach ($this->potions as $index => $potion) {
            if ($potion->getHealing() > $this->potions[$bestIndex]->getHealing()) {
                $bestIndex = $index;
            }
        }

        // Recuperamos la vida y retiramos únicamente la poción usada.
        $this->health += $this->potions[$bestIndex]->getHealing();
        unset($this->potions[$bestIndex]);
    }

    // Prepara el texto que se muestra al imprimir el héroe.
    public function __toString(): string
    {
        $weapons = $this->weapons === [] ? 'ninguna' : implode(', ', $this->weapons);
        $armor = $this->armor === null ? 'ninguna' : (string) $this->armor;
        $potionCount = count($this->potions);
        $potions = $this->potions === [] ? 'ninguna' : implode(', ', $this->potions);

        return "Héroe: {$this->name}\n"
            . "Especie: {$this->species}\n"
            . "Clase: {$this->class}\n"
            . "Salud: {$this->health}\n"
            . "Ataque base: {$this->baseAttack}\n"
            . "Defensa base: {$this->baseDefense}\n"
            . "Armas: {$weapons}\n"
            . "Armadura: {$armor}\n"
            . "Pociones ({$potionCount}): {$potions}";
    }
}