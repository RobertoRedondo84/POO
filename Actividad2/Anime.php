<?php

require_once __DIR__ . '/Character.php';

class Anime
{
    private const GENRES = ['Kodomo', 'Shonen', 'Shojo', 'Seinen', 'Josei'];

    private string $title;
    private string $author;
    private string $genre;
    private int $episodes;
    private int $year;
    private array $characters = [];

    public function __construct(
        string $title,
        string $author,
        string $genre,
        int $episodes,
        int $year = -1
    ) {
        $this->title = $title;
        $this->author = $author;
        $this->episodes = $episodes;
        $this->__set('genre', $genre);
        $this->__set('year', $year);
    }

    public function __get(string $property): mixed
    {
        return match ($property) {
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'episodes' => $this->episodes,
            'year' => $this->year,
            'characters' => $this->characters,
            default => throw new InvalidArgumentException("Propiedad desconocida: $property"),
        };
    }

    public function __set(string $property, mixed $value): void
    {
        switch ($property) {
            case 'title':
                $this->title = $value;
                break;
            case 'author':
                $this->author = $value;
                break;
            case 'genre':
                $this->genre = $this->checkGenre($value) ? $value : 'desconocido';
                break;
            case 'episodes':
                $this->episodes = $value;
                break;
            case 'year':
                $this->year = $this->checkYear($value) ? $value : -1;
                break;
            default:
                throw new InvalidArgumentException("Propiedad no modificable: $property");
        }
    }

    private function checkYear(int $year): bool
    {
        return $year >= 1917;
    }

    private function checkGenre(string $genre): bool
    {
        return in_array($genre, self::GENRES, true);
    }

    private function checkCharacter(Character $character): bool
    {
        foreach ($this->characters as $registeredCharacter) {
            if ($registeredCharacter->name === $character->name) {
                return true;
            }
        }

        return false;
    }

    public function countCharacters(): int
    {
        return count($this->characters);
    }

    public function addCharacter(Character $character): bool
    {
        if ($this->checkCharacter($character)) {
            return false;
        }

        $this->characters[] = $character;
        return true;
    }

    public function removeCharacter(string $name): Character|false
    {
        foreach ($this->characters as $index => $character) {
            if ($character->name === $name) {
                array_splice($this->characters, $index, 1);
                return $character;
            }
        }

        return false;
    }
}