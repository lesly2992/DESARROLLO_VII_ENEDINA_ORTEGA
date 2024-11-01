<?php
require_once "config_pdo.php";

try {
    // 1. Productos que tienen un precio mayor al promedio de su categoría
    $sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
            (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE p.precio > (
                SELECT AVG(precio)
                FROM productos p2
                WHERE p2.categoria_id = p.categoria_id
            )";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }

    // 2. Clientes con compras superiores al promedio
    $sql = "SELECT c.nombre, c.email,
            (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
            (SELECT AVG(total) FROM ventas) as promedio_ventas
            FROM clientes c
            WHERE (
                SELECT SUM(total)
                FROM ventas
                WHERE cliente_id = c.id
            ) > (
                SELECT AVG(total)
                FROM ventas
            )";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//Productos que nunca se han vendido
try {
    $sql = "SELECT nombre FROM productos WHERE id NOT IN (SELECT producto_id FROM detalles_venta)";
    $stmt = $pdo->query($sql);

    echo "<h3>Productos que nunca se han vendido:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}<br>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//Listar las categorías con el número de productos y el valor total del inventario.
try {
    $sql = "SELECT c.nombre AS categoria, COUNT(p.id) AS numero_productos, 
            SUM(p.precio * p.stock) AS valor_inventario
            FROM categorias c
            LEFT JOIN productos p ON c.id = p.categoria_id
            GROUP BY c.id";
    $stmt = $pdo->query($sql);

    echo "<h3>Categorías con el número de productos y valor total del inventario:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Categoría: {$row['categoria']}, Productos: {$row['numero_productos']}, ";
        echo "Valor Inventario: {$row['valor_inventario']}<br>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//Encontrar los clientes que han comprado todos los productos de una categoría específica.
try {
    
    $categoria_id = 1; //id de la categoria que estamos buscando

    $sql = "SELECT c.nombre AS cliente, c.email
            FROM clientes c
            WHERE NOT EXISTS (
                SELECT p.id
                FROM productos p
                WHERE p.categoria_id = :categoria_id
                AND NOT EXISTS (
                    SELECT dv.producto_id
                    FROM ventas v
                    JOIN detalles_venta dv ON v.id = dv.venta_id
                    WHERE v.cliente_id = c.id AND dv.producto_id = p.id
                )
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['categoria_id' => $categoria_id]);

    echo "<h3>Clientes que han comprado todos los productos de la categoría específica:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['cliente']}, Email: {$row['email']}<br>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//Calcular el porcentaje de ventas de cada producto respecto al total de ventas.
try {
    $sql = "SELECT p.nombre, 
            SUM(dv.subtotal) / (SELECT SUM(subtotal) FROM detalles_venta) * 100 AS porcentaje_ventas
            FROM productos p
            JOIN detalles_venta dv ON p.id = dv.producto_id
            GROUP BY p.id";
    $stmt = $pdo->query($sql);

    echo "<h3>Porcentaje de ventas de cada producto respecto al total de ventas:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Porcentaje de Ventas: {$row['porcentaje_ventas']}%<br>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>