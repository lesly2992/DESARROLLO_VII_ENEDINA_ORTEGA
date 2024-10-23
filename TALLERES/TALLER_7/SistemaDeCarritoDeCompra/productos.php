<?php include 'config_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <form action="agregar_al_carrito.php" method="POST">
        <ul>
            <li>
                Producto 1 - $10 
                <button type="submit" name="producto" value="Producto 1|10">Añadir al carrito</button>
            </li>
            <li>
                Producto 2 - $20 
                <button type="submit" name="producto" value="Producto 2|20">Añadir al carrito</button>
            </li>
            <li>
                Producto 3 - $30 
                <button type="submit" name="producto" value="Producto 3|30">Añadir al carrito</button>
            </li>
        </ul>
    </form>
</body>
</html>
