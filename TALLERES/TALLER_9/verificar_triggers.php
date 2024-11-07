<?php
require_once "config_pdo.php"; // O usar mysqli según prefieras

function verificarCambiosPrecio($pdo, $producto_id, $nuevo_precio) {
    try {
        // Actualizar precio
        $stmt = $pdo->prepare("UPDATE productos SET precio = ? WHERE id = ?");
        $stmt->execute([$nuevo_precio, $producto_id]);
        
        // Verificar log de cambios
        $stmt = $pdo->prepare("SELECT * FROM historial_precios WHERE producto_id = ? ORDER BY fecha_cambio DESC LIMIT 1");
        $stmt->execute([$producto_id]);
        $log = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<h3>Cambio de Precio Registrado:</h3>";
        echo "Precio anterior: $" . $log['precio_anterior'] . "<br>";
        echo "Precio nuevo: $" . $log['precio_nuevo'] . "<br>";
        echo "Fecha del cambio: " . $log['fecha_cambio'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function verificarMovimientoInventario($pdo, $producto_id, $nueva_cantidad) {
    try {
        // Actualizar stock
        $stmt = $pdo->prepare("UPDATE productos SET stock = ? WHERE id = ?");
        $stmt->execute([$nueva_cantidad, $producto_id]);
        
        // Verificar movimientos de inventario
        $stmt = $pdo->prepare("
            SELECT * FROM movimientos_inventario 
            WHERE producto_id = ? 
            ORDER BY fecha_movimiento DESC LIMIT 1
        ");
        $stmt->execute([$producto_id]);
        $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<h3>Movimiento de Inventario Registrado:</h3>";
        echo "Tipo de movimiento: " . $movimiento['tipo_movimiento'] . "<br>";
        echo "Cantidad: " . $movimiento['cantidad'] . "<br>";
        echo "Stock anterior: " . $movimiento['stock_anterior'] . "<br>";
        echo "Stock nuevo: " . $movimiento['stock_nuevo'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function verificarMembresiaCliente($pdo, $cliente_id, $total_compra) {
    try {
        // Insertar una venta para disparar el trigger
        $stmt = $pdo->prepare("INSERT INTO ventas (cliente_id, total) VALUES (?, ?)");
        $stmt->execute([$cliente_id, $total_compra]);
        
        // Verificar el nivel de membresía
        $stmt = $pdo->prepare("SELECT nivel_membresia FROM clientes WHERE id = ?");
        $stmt->execute([$cliente_id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "Nivel de Membresía Actualizado: " . $cliente['nivel_membresia'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function verificarEstadisticasCategoria($pdo, $venta_id, $producto_id, $cantidad) {
    try {
        // Insertar detalle de venta para disparar el trigger
        $stmt = $pdo->prepare("INSERT INTO detalles_venta (venta_id, producto_id, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$venta_id, $producto_id, $cantidad]);
        
        // Verificar estadísticas de la categoría
        $stmt = $pdo->prepare("
            SELECT ec.categoria_id, ec.total_ventas
            FROM estadisticas_categorias ec
            JOIN productos p ON ec.categoria_id = p.categoria_id
            WHERE p.id = ?
        ");
        $stmt->execute([$producto_id]);
        $estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "Total de Ventas en la Categoría: " . $estadisticas['total_ventas'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function verificarAlertaStock($pdo, $producto_id, $nuevo_stock) {
    try {
        // Actualizar stock para disparar el trigger
        $stmt = $pdo->prepare("UPDATE productos SET stock = ? WHERE id = ?");
        $stmt->execute([$nuevo_stock, $producto_id]);
        
        // Verificar alertas de stock
        $stmt = $pdo->prepare("SELECT * FROM alertas_stock WHERE producto_id = ? ORDER BY fecha_alerta DESC LIMIT 1");
        $stmt->execute([$producto_id]);
        $alerta = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "Alerta de Stock: " . $alerta['mensaje'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function verificarHistorialEstadoCliente($pdo, $cliente_id, $nuevo_estado) {
    try {
        // Actualizar estado para disparar el trigger
        $stmt = $pdo->prepare("UPDATE clientes SET estado = ? WHERE id = ?");
        $stmt->execute([$nuevo_estado, $cliente_id]);
        
        // Verificar historial de cambios de estado
        $stmt = $pdo->prepare("SELECT * FROM historial_estados_clientes WHERE cliente_id = ? ORDER BY fecha_cambio DESC LIMIT 1");
        $stmt->execute([$cliente_id]);
        $historial = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "Cambio de Estado: " . $historial['estado_anterior'] . " a " . $historial['estado_nuevo'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


// Probar los triggers
verificarCambiosPrecio($pdo, 1, 999.99);
verificarMovimientoInventario($pdo, 1, 15);

$pdo = null;

?>