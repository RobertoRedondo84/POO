<?php

declare(strict_types=1);

foreach (['Cliente', 'Producto', 'LineaPedido', 'Pago', 'Cheque', 'Efectivo', 'Tarjeta', 'Pedido'] as $clase) {
    require_once __DIR__ . '/' . $clase . '.php';
}

function euros(int $centimos): string
{
    return number_format($centimos / 100, 2, ',', '.') . ' €';
}

function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$cliente = new Cliente('Lucía García', 'Calle Mayor, 10');
$teclado = new Producto('Teclado', 0.75, 10, 2590);
$raton = new Producto('Ratón', 0.12, 20, 1495);
$alfombrilla = new Producto('Alfombrilla', 0.25, 15, 850);
$productos = [$teclado, $raton, $alfombrilla];

$pedidoTarjeta = new Pedido($cliente, new DateTimeImmutable('2026-11-24'), 'Pagado', null);
$pedidoTarjeta->agregarLinea($teclado, 1);
$pedidoTarjeta->agregarLinea($raton, 2);
$pedidoTarjeta->setPago(new Tarjeta($pedidoTarjeta->calcularTotal(), '4242424242424242', '12/29'));

$pedidoEfectivo = new Pedido($cliente, new DateTimeImmutable('2026-11-25'), 'Pagado', null);
$pedidoEfectivo->agregarLinea($raton, 1);
$pedidoEfectivo->agregarLinea($alfombrilla, 2);
$pedidoEfectivo->setPago(new Efectivo($pedidoEfectivo->calcularTotal(), $cliente->getNombre()));

$pedidoCheque = new Pedido($cliente, new DateTimeImmutable('2026-11-26'), 'Pagado', null);
$pedidoCheque->agregarLinea($teclado, 2);
$pedidoCheque->agregarLinea($alfombrilla, 1);
$pedidoCheque->setPago(new Cheque($pedidoCheque->calcularTotal(), $cliente->getNombre(), 'Banco de ejemplo'));

$pedidos = [$pedidoTarjeta, $pedidoEfectivo, $pedidoCheque];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de pedidos</title>
</head>
<body>
    <main>
        <h1>Gestión de pedidos</h1>
        <h2>Productos</h2>
        <ul>
            <?php foreach ($productos as $producto): ?>
                <li><?= escapar((string) $producto) ?></li>
            <?php endforeach; ?>
        </ul>

        <?php foreach ($pedidos as $indice => $pedido): ?>
            <article>
                <h2>Pedido <?= $indice + 1 ?></h2>
                <p>Cliente: <?= escapar((string) $pedido->getCliente()) ?></p>
                <p><?= escapar((string) $pedido) ?></p>
                <ul>
                    <?php foreach ($pedido->getLineas() as $linea): ?>
                        <li><?= escapar((string) $linea) ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>Pago: <?= escapar((string) $pedido->getPago()) ?></p>
            </article>
        <?php endforeach; ?>
    </main>
</body>
</html>
