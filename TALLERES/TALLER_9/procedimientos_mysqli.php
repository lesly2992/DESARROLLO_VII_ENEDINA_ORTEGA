<?php
require_once "config_mysqli.php";

// Función para registrar una venta
function registrarVenta($conn, $cliente_id, $producto_id, $cantidad) {
    $query = "CALL sp_registrar_venta(?, ?, ?, @venta_id)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $cliente_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el ID de la venta
        $result = mysqli_query($conn, "SELECT @venta_id as venta_id");
        $row = mysqli_fetch_assoc($result);
        
        echo "Venta registrada con éxito. ID de venta: " . $row['venta_id'];
    } catch (Exception $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($conn, $cliente_id) {
    $query = "CALL sp_estadisticas_cliente(?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cliente_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $estadisticas = mysqli_fetch_assoc($result);
        
        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    }
    
    mysqli_stmt_close($stmt);
}

function procesarDevolucion($conn, $venta_id, $producto_id, $cantidad) {
    $query = "CALL sp_procesar_devolucion(?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $venta_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        echo "Devolución procesada con éxito.";
    } catch (Exception $e) {
        echo "Error al procesar la devolución: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

function aplicarDescuentoCliente($conn, $cliente_id, $porcentaje_descuento) {
    $query = "CALL sp_aplicar_descuento_cliente(?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "id", $cliente_id, $porcentaje_descuento);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Descuento aplicado correctamente.";
    } else {
        echo "Error al aplicar descuento.";
    }
    
    mysqli_stmt_close($stmt);
}

function reporteBajoStock($conn, $stock_minimo) {
    $query = "CALL sp_reporte_bajo_stock(?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $stock_minimo);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while ($producto = mysqli_fetch_assoc($result)) {
            echo "Producto: " . $producto['nombre'] . " | Stock: " . $producto['stock'] . " | Reponer: " . $producto['cantidad_reponer'] . "<br>";
        }
    }
    
    mysqli_stmt_close($stmt);
}


// Ejemplos de uso
registrarVenta($conn, 1, 1, 2);
obtenerEstadisticasCliente($conn, 1);

mysqli_close($conn);
?>