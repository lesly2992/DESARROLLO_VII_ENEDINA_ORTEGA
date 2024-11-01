<?php
require_once "config_pdo.php";

function mostrarResumenCategorias($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_resumen_categorias");

        echo "<h3>Resumen por Categorías:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Categoría</th>
                <th>Total Productos</th>
                <th>Stock Total</th>
                <th>Precio Promedio</th>
                <th>Precio Mínimo</th>
                <th>Precio Máximo</th>
              </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['categoria']}</td>";
            echo "<td>{$row['total_productos']}</td>";
            echo "<td>{$row['total_stock']}</td>";
            echo "<td>${$row['precio_promedio']}</td>";
            echo "<td>${$row['precio_minimo']}</td>";
            echo "<td>${$row['precio_maximo']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function mostrarProductosPopulares($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_productos_populares LIMIT 5");

        echo "<h3>Top 5 Productos Más Vendidos:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Total Vendido</th>
                <th>Ingresos Totales</th>
                <th>Compradores Únicos</th>
              </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['producto']}</td>";
            echo "<td>{$row['categoria']}</td>";
            echo "<td>{$row['total_vendido']}</td>";
            echo "<td>${$row['ingresos_totales']}</td>";
            echo "<td>{$row['compradores_unicos']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Una vista que muestre los productos con bajo stock (menos de 5 unidades) junto con su información de ventas.
function mostrarBajoStock($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_bajo_stock");
        echo "<h3>Productos con bajo stock (menos de 5 unidades):</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Total Vendido</th>
                    <th>Ingresos Totales</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['producto']}</td>
                    <td>{$row['categoria']}</td>
                    <td>{$row['stock']}</td>
                    <td>{$row['total_vendido']}</td>
                    <td>${$row['ingresos_totales']}</td>
                  </tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

mostrarBajoStock($pdo);

//Una vista que muestre el historial completo de cada cliente, incluyendo productos comprados y montos totales.
function mostrarHistorialClientes($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_historial_clientes");

        echo "<h3>Historial de Compras de Clientes:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Venta ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Fecha de Venta</th>
                    <th>Estado</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['cliente']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['venta_id']}</td>
                    <td>{$row['producto']}</td>
                    <td>{$row['cantidad']}</td>
                    <td>${$row['subtotal']}</td>
                    <td>{$row['fecha_venta']}</td>
                    <td>{$row['estado']}</td>
                  </tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

mostrarHistorialClientes($pdo);

//Una vista que calcule métricas de rendimiento por categoría (ventas totales, cantidad de productos, productos más vendidos).
function mostrarRendimientoCategoria($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_rendimiento_categoria");

        echo "<h3>Métricas de Rendimiento por Categoría:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Categoría</th>
                    <th>Total de Productos</th>
                    <th>Total Vendido</th>
                    <th>Ingresos Totales</th>
                    <th>Producto Más Vendido</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['categoria']}</td>
                    <td>{$row['total_productos']}</td>
                    <td>{$row['total_vendido']}</td>
                    <td>${$row['ingresos_totales']}</td>
                    <td>{$row['producto_mas_vendido']}</td>
                  </tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

mostrarRendimientoCategoria($pdo);

//Una vista que muestre las tendencias de ventas por mes, incluyendo comparativas con meses anteriores.
function mostrarTendenciasVentas($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_tendencias_ventas");

        echo "<h3>Tendencias de Ventas por Mes:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Ingresos Totales</th>
                    <th>Ventas Totales</th>
                    <th>Ingresos Mes Anterior</th>
                    <th>Crecimiento (%)</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['anio']}</td>
                    <td>{$row['mes']}</td>
                    <td>${$row['ingresos_totales']}</td>
                    <td>{$row['ventas_totales']}</td>
                    <td>${$row['ingresos_mes_anterior']}</td>
                    <td>{$row['crecimiento_percent']}%</td>
                  </tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

mostrarTendenciasVentas($pdo);

// Mostrar los resultados
mostrarResumenCategorias($pdo);
mostrarProductosPopulares($pdo);

$pdo = null;
?>