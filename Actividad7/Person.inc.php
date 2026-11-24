<?php

declare(strict_types=1);

class Person
{
    public function __construct(private string $name, private DateTimeImmutable $birthday)
    {
    }

    public function __toString(): string
    {
        return $this->name . ' · Nacimiento ' . $this->birthday->format('d/m/Y');
    }
}
