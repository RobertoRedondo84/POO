<?php

require_once __DIR__ . '/Character.php';

$goku = new Character('Goku', 'Masculino', -5, 'Saiyan2');

var_dump($goku->age);     // int(-1)
var_dump($goku->species); // string(11) "desconocida"

$goku->age = 30;
$goku->species = 'Saiyan';

var_dump($goku->age);     // int(30)
var_dump($goku->species); // string(6) "Saiyan"

$luffy = new Character('Luffy', 'Masculino');
var_dump($luffy->species); // string(6) "humano"