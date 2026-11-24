<?php

declare(strict_types=1);

class GrandPrix
{
    private array $positions = [];

    public function __construct(private Circuit $circuit, private int $date)
    {
    }

    public function addRider(int $position, Rider $rider): bool
    {
        if ($position < 1 || isset($this->positions[$position])) {
            return false;
        }

        foreach ($this->positions as $registeredRider) {
            if ($registeredRider->getNumber() === $rider->getNumber()) {
                return false;
            }
        }

        $this->positions[$position] = $rider;
        return true;
    }

    /** @return array<int, Rider> */
    public function results(): array
    {
        $results = $this->positions;
        ksort($results, SORT_NUMERIC);
        return $results;
    }

    public function __toString(): string
    {
        return gmdate('d/m/Y', $this->date) . ' · ' . $this->circuit;
    }
}
