<?php

declare(strict_types=1);

class Season
{
    /** @var list<GrandPrix> */
    private array $races = [];

    public function addGrandPrix(GrandPrix $race): void
    {
        if (!in_array($race, $this->races, true)) {
            $this->races[] = $race;
        }
    }

    /** @return list<GrandPrix> */
    public function getRaces(): array
    {
        return $this->races;
    }

    /** @return list<array{rider: Rider, points: int, finishes: array<int, int>, bestDate: int}> */
    public function standings(): array
    {
        $standings = [];

        foreach ($this->races as $race) {
            foreach ($race->scoredResults() as $position => $result) {
                $rider = $result['rider'];
                $number = $rider->getNumber();
                $standings[$number] ??= [
                    'rider' => $rider,
                    'points' => 0,
                    'finishes' => [],
                    'bestDate' => PHP_INT_MIN,
                ];

                $entry = $standings[$number];
                $entry['points'] += $result['points'];
                $entry['finishes'][$position] = ($entry['finishes'][$position] ?? 0) + 1;
                $bestPosition = min(array_keys($entry['finishes']));

                if ($position === $bestPosition) {
                    $entry['bestDate'] = $entry['finishes'][$position] === 1
                        ? $race->getDate()
                        : max($entry['bestDate'], $race->getDate());
                }

                $standings[$number] = $entry;
            }
        }

        usort($standings, [$this, 'compareEntries']);
        return $standings;
    }

    public function bestRider(): ?Rider
    {
        return $this->standings()[0]['rider'] ?? null;
    }

    private function compareEntries(array $a, array $b): int
    {
        $pointsOrder = $b['points'] <=> $a['points'];
        if ($pointsOrder !== 0) {
            return $pointsOrder;
        }

        // Solo recorremos las posiciones que alguien ha conseguido.
        $positions = array_keys($a['finishes'] + $b['finishes']);
        sort($positions, SORT_NUMERIC);

        foreach ($positions as $position) {
            $finishOrder = ($b['finishes'][$position] ?? 0) <=> ($a['finishes'][$position] ?? 0);
            if ($finishOrder !== 0) {
                return $finishOrder;
            }
        }

        return $b['bestDate'] <=> $a['bestDate'];
    }
}
