<?php

declare(strict_types=1);

$users = require __DIR__ . '/userList.inc.php';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!is_string($username) || trim($username) === '' || !is_string($password) || $password === '') {
        $mensaje = 'Introduce el usuario y la contraseña.';
    } else {
        $user = userExists(trim($username), $users);

        if ($user === false || !$user->login($password)) {
            $mensaje = 'Usuario o contraseña incorrectos.';
        } else {
            $mensaje = 'Inicio de sesión correcto. Bienvenido, ' . $user . '.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda de contactos</title>
</head>
<body>
    <main>
        <h1>Agenda de contactos</h1>
        <form method="post">
            <p><label>Usuario <input name="username" autocomplete="username" required></label></p>
            <p><label>Contraseña <input type="password" name="password" autocomplete="current-password" required></label></p>
            <button>Iniciar sesión</button>
        </form>
        <?php if ($mensaje !== ''): ?>
            <p><?= htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
