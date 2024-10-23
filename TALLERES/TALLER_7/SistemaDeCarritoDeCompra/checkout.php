<?php
include 'config_sesion.php';

// Resumen de la compra
$total = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }
}

// Guardar el nombre del usuario en una cookie por 24 horas
setcookie('usuario', 'Cliente', time() + 86400, '/', '', isset($_SERVER['HTTPS']), true);

// Vaciar el carrito
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Compra</title>
</head>
<body>
    <h1>¡Gracias por tu compra!</h1>
    <p>Total pagado: $<?php echo $total; ?></p>
    <a href="productos.php">Volver a la tienda</a>
</body>
</html>
