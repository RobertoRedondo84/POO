<?php

declare(strict_types=1);

class GrandPrix
{
    // Puntos de la carrera principal, desde la primera hasta la 15.ª posición.
    private const RACE_POINTS = [
        1 => 25, 20, 16, 13, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1,
    ];

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

    public function getDate(): int
    {
        return $this->date;
    }

    /** @return array<int, array{rider: Rider, points: int}> */
    public function scoredResults(): array
    {
        $results = [];

        foreach ($this->results() as $position => $rider) {
            $results[$position] = [
                'rider' => $rider,
                'points' => self::RACE_POINTS[$position] ?? 0,
            ];
        }

        return $results;
    }

    public function __toString(): string
    {
        return gmdate('d/m/Y', $this->date) . ' · ' . $this->circuit;
    }
}
