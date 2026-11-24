<?php

declare(strict_types=1);

require_once __DIR__ . '/Person.inc.php';
require_once __DIR__ . '/Mechanic.inc.php';
require_once __DIR__ . '/Rider.inc.php';
require_once __DIR__ . '/Team.inc.php';
require_once __DIR__ . '/Circuit.inc.php';
require_once __DIR__ . '/GrandPrix.inc.php';
require_once __DIR__ . '/Season.inc.php';

function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
