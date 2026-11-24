<?php

declare(strict_types=1);

class Rider extends Person
{
    public function __construct(string $name, DateTimeImmutable $birthday, private int $number)
    {
        parent::__construct($name, $birthday);
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function __toString(): string
    {
        return "#$this->number · " . parent::__toString();
    }
}
