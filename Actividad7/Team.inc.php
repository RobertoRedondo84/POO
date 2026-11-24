<?php

declare(strict_types=1);

class Team
{
    private array $riders = [];
    private array $mechanics = [];

    public function __construct(private string $name, private int $country)
    {
    }

    public function addRider(Rider $rider): void
    {
        $this->riders[] = $rider;
    }

    public function addMechanic(Mechanic $mechanic): void
    {
        $this->mechanics[] = $mechanic;
    }

    /** @return list<Rider> */
    public function getRiders(): array
    {
        return $this->riders;
    }

    /** @return list<Mechanic> */
    public function getMechanics(): array
    {
        return $this->mechanics;
    }

    public function __toString(): string
    {
        return "$this->name · Código de país $this->country";
    }
}
