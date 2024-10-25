<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];

    if (empty($titulo) || empty($fecha)) {
        die("Todos los campos son obligatorios.");
    }

    if (strtotime($fecha) < strtotime(date('Y-m-d'))) {
        die("La fecha debe ser futura.");
    }

    $_SESSION['tareas'][] = [
        'titulo' => $titulo,
        'fecha' => $fecha
    ];

    header('Location: dashboard.php');
    exit;
} else {
    header('Location: dashboard.php');
    exit;
}
?>
