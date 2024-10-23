<?php
include 'config_sesion.php';

if (isset($_POST['producto'])) {
    list($nombre, $precio) = explode('|', $_POST['producto']);

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$nombre])) {
        $_SESSION['carrito'][$nombre]['cantidad']++;
    } else {
        $_SESSION['carrito'][$nombre] = ['precio' => $precio, 'cantidad' => 1];
    }
}

header('Location: ver_carrito.php');
exit();
?>
