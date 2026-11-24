<?php

declare(strict_types=1);

require_once __DIR__ . '/utils.inc.php';

$levante = new Team('Levante Racing', 724);
$adriatico = new Team('Adriatico Corse', 380);

$alba = new Rider('Alba Martín', new DateTimeImmutable('1998-04-10'), 12);
$marc = new Rider('Marc Vidal', new DateTimeImmutable('2000-07-19'), 28);
$luca = new Rider('Luca Rossi', new DateTimeImmutable('1999-02-16'), 43);
$giulia = new Rider('Giulia Costa', new DateTimeImmutable('2001-09-01'), 57);

$levante->addRider($alba);
$levante->addRider($marc);
$adriatico->addRider($luca);
$adriatico->addRider($giulia);

$levante->addMechanic(new Mechanic('Elena Soler', new DateTimeImmutable('1990-06-02'), 'Motor'));
$levante->addMechanic(new Mechanic('Pau Ferrer', new DateTimeImmutable('1992-03-12'), 'Suspensión'));
$adriatico->addMechanic(new Mechanic('Sofia Bianchi', new DateTimeImmutable('1989-10-22'), 'Electrónica'));
$adriatico->addMechanic(new Mechanic('Marco Conti', new DateTimeImmutable('1993-12-05'), 'Frenos'));

$teams = [$levante, $adriatico];

$cheste = new Circuit('Circuito del Turia', 'España', 25, 'Cheste', 4.005, 9, 5);
$jerez = new Circuit('Circuito del Sur', 'España', 24, 'Jerez de la Frontera', 4.425, 5, 8);
$misano = new Circuit('Circuito del Adriático', 'Italia', 27, 'Misano Adriatico', 4.226, 6, 10);

$grandPrix = [
    new GrandPrix($cheste, gmmktime(0, 0, 0, 4, 12, 2026)),
    new GrandPrix($jerez, gmmktime(0, 0, 0, 5, 17, 2026)),
    new GrandPrix($misano, gmmktime(0, 0, 0, 9, 13, 2026)),
];

$raceOrders = [
    [2 => $luca, 1 => $alba, 4 => $giulia, 3 => $marc],
    [1 => $luca, 2 => $giulia, 3 => $alba, 4 => $marc],
    [1 => $marc, 2 => $alba, 3 => $giulia, 4 => $luca],
];

foreach ($grandPrix as $index => $race) {
    foreach ($raceOrders[$index] as $position => $rider) {
        $race->addRider($position, $rider);
    }
}

$duplicateAccepted = $grandPrix[0]->addRider(1, new Rider(
    'Alex Serra',
    new DateTimeImmutable('2002-01-10'),
    64
));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 6 · MotoGP</title>
</head>
<body>
    <main>
        <h1>MotoGP</h1>
        <h2>Equipos</h2>
        <?php foreach ($teams as $team): ?>
            <article>
                <h3><?= escapar((string) $team) ?></h3>
                <h4>Pilotos</h4>
                <ul>
                    <?php foreach ($team->getRiders() as $rider): ?>
                        <li><?= escapar((string) $rider) ?></li>
                    <?php endforeach; ?>
                </ul>
                <h4>Mecánicos</h4>
                <ul>
                    <?php foreach ($team->getMechanics() as $mechanic): ?>
                        <li><?= escapar((string) $mechanic) ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        <?php endforeach; ?>

        <h2>Grandes premios</h2>
        <?php foreach ($grandPrix as $race): ?>
            <article>
                <h3><?= escapar((string) $race) ?></h3>
                <ol>
                    <?php foreach ($race->results() as $position => $rider): ?>
                        <li value="<?= $position ?>"><?= escapar((string) $rider) ?></li>
                    <?php endforeach; ?>
                </ol>
            </article>
        <?php endforeach; ?>
        <p>Prueba de posición ocupada en el primer gran premio:
            <?= $duplicateAccepted ? 'error, se aceptó la inscripción' : 'inscripción rechazada' ?>.
        </p>
    </main>
</body>
</html>
