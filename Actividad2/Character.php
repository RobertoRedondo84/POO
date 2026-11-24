<?php

class Character
{
    private string $name;
    private int $age;
    private string $genre;
    private string $species;

    public function __construct(
        string $name,
        string $genre,
        int $age = -1,
        string $species = 'humano'
    ) {
        $this->name = $name;
        $this->genre = $genre;
        $this->__set('age', $age);
        $this->__set('species', $species);
    }

    public function __get(string $property): mixed
    {
        return match ($property) {
            'name' => $this->name,
            'age' => $this->age,
            'genre' => $this->genre,
            'species' => $this->species,
            default => throw new InvalidArgumentException("Propiedad desconocida: $property"),
        };
    }

    public function __set(string $property, mixed $value): void
    {
        switch ($property) {
            case 'name':
                $this->name = $value;
                break;
            case 'genre':
                $this->genre = $value;
                break;
            case 'age':
                $this->age = $this->checkAge($value) ? $value : -1;
                break;
            case 'species':
                $this->species = $this->checkSpecies($value) ? $value : 'desconocida';
                break;
            default:
                throw new InvalidArgumentException("Propiedad desconocida: $property");
        }
    }

    private function checkAge(int $age): bool
    {
        return $age >= 0;
    }

    private function checkSpecies(string $species): bool
    {
        return preg_match('/[0-9]/', $species) === 0;
    }
}