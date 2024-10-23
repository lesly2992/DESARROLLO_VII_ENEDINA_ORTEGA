<?php include 'config_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <ul>
        <?php
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $nombre => $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
                echo "<li>$nombre - {$producto['cantidad']} x \${$producto['precio']} = \$$subtotal 
                    <a href='eliminar_del_carrito.php?producto=$nombre'>Eliminar</a></li>";
            }
        } else {
            echo "<li>El carrito está vacío.</li>";
        }
        ?>
    </ul>
    <p>Total: $<?php echo $total; ?></p>
    <a href="checkout.php">Checkout</a>
</body>
</html>
