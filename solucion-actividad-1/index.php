<?php

// __DIR__ apunta a la carpeta donde está este archivo.
require_once __DIR__ . '/Weapon.php';
require_once __DIR__ . '/Armor.php';
require_once __DIR__ . '/Potion.php';
require_once __DIR__ . '/Hero.php';

// 1. Crear el héroe con los valores por defecto de salud, ataque y defensa.
$hero = new Hero('Aragorn', 'humano', 'guerrero');
$initialState = (string) $hero;

// 2. Equipar al héroe mediante el setter mágico.
$hero->weapons = [
    new Weapon('Espada', 15),
    new Weapon('Daga', 5),
];

$hero->armor = new Armor('Armadura de acero', 20);

$hero->potions = [
    new Potion('Poción pequeña', 10),
    new Potion('Poción grande', 30),
    new Potion('Poción mediana', 20),
];

$equippedState = (string) $hero;

// 3. Calcular el ataque y probar la defensa con dos cantidades de daño.
$attack = $hero->attack();
$defenseAgainst15 = $hero->defense(15);
$defenseAgainst40 = $hero->defense(40);

// 4. Usar la mejor poción y guardar el estado final.
$healthBefore = $hero->health;
$hero->usePotion();
$healthAfter = $hero->health;
$finalState = (string) $hero;

// 5. Probar los valores por defecto al modificar especie y clase.
$hero->species = 'dragón';
$hero->class = 'clase desconocida';

$validatedSpecies = $hero->species;
$validatedClass = $hero->class;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Inventario de héroe</title>
</head>
<body>
    <h1>Inventario de héroe</h1>

    <h2>Estado inicial</h2>
    <pre><?= htmlspecialchars($initialState) ?></pre>

    <h2>Después de equipar al héroe</h2>
    <pre><?= htmlspecialchars($equippedState) ?></pre>

    <h2>Pruebas de ataque y defensa</h2>
    <ul>
        <li>Ataque total: <?= $attack ?></li>
        <li>Defensa frente a 15 de daño: <?= $defenseAgainst15 ?></li>
        <li>Defensa frente a 40 de daño: <?= $defenseAgainst40 ?></li>
    </ul>

    <h2>Después de usar la mejor poción</h2>
    <p>La salud pasa de <?= $healthBefore ?> a <?= $healthAfter ?>.</p>
    <pre><?= htmlspecialchars($finalState) ?></pre>

    <h2>Prueba con una especie y una clase inválidas</h2>
    <ul>
        <li>Especie asignada: <?= htmlspecialchars($validatedSpecies) ?></li>
        <li>Clase asignada: <?= htmlspecialchars($validatedClass) ?></li>
    </ul>
</body>
</html>