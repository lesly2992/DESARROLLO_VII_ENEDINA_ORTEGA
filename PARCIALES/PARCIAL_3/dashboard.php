<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
    <a href="logout.php">Cerrar Sesión</a>

    <h3>Lista de Tareas</h3>
    <ul>
        <?php foreach ($_SESSION['tareas'] as $tarea): ?>
            <li><?php echo htmlspecialchars($tarea['titulo']) . " - " . $tarea['fecha']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Agregar Tarea</h3>
    <form method="POST" action="agregar.php">
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="date" name="fecha" required>
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
