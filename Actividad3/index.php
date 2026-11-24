<?php

declare(strict_types=1);

require_once __DIR__ . '/Vehiculo.php';

$moto = new Moto('Honda', 'CB500F', 471, '1234 ABC', 2, false);
$coche = new Coche('Mazda', 'MX-5', 1998, '2345 BCD', 2, true);
$cocheFijo = new Coche('Seat', 'Ibiza', 999, '3456 CDF', 5, false);
$camion = new Camion('Volvo', 'FH', 12800, '4567 DFG', 8000, 12000, 3);

$vehiculos = [$moto, $coche, $cocheFijo, $camion];

function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 3 · Vehículos</title>
</head>
<body>
    <h1>Estructura de vehículos</h1>

    <h2>Vehículos del ejemplo</h2>
    <ul>
        <?php foreach ($vehiculos as $vehiculo): ?>
            <li><?= escapar((string) $vehiculo) ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Métodos específicos</h2>
    <ul>
        <li><?= escapar($moto->frenarDelantero()) ?></li>
        <li><?= escapar($moto->frenarTrasero()) ?></li>
        <li><?= escapar($coche->quitarCapota()) ?></li>
        <li><?= escapar($cocheFijo->quitarCapota()) ?></li>
    </ul>

    <h2>Prueba de los getters y setters mágicos</h2>
    <?php
    $matriculaAnterior = $moto->matricula;
    $moto->matricula = '5678 FGH';

    $cargaAnterior = $camion->carga;
    $camion->carga = 10000;
    ?>
    <ul>
        <li>Matrícula de la moto: <?= escapar($matriculaAnterior) ?> → <?= escapar($moto->matricula) ?></li>
        <li>Carga del camión: <?= $cargaAnterior ?> kg → <?= $camion->carga ?> kg</li>
    </ul>
</body>
</html>