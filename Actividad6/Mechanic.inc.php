<?php

declare(strict_types=1);

class Mechanic extends Person
{
    public function __construct(string $name, DateTimeImmutable $birthday, private string $speciality)
    {
        parent::__construct($name, $birthday);
    }

    public function __toString(): string
    {
        return parent::__toString() . ' · ' . $this->speciality;
    }
}
