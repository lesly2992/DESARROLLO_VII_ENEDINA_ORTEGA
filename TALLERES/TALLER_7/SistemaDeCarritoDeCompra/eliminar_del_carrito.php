<?php
include 'config_sesion.php';

if (isset($_GET['producto']) && isset($_SESSION['carrito'][$_GET['producto']])) {
    unset($_SESSION['carrito'][$_GET['producto']]);
}

header('Location: ver_carrito.php');
exit();
?>
