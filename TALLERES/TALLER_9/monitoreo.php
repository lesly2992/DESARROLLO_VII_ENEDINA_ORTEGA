<?php
require_once "config_pdo.php";

function monitorearConsulta($pdo, $sql) {
    try {
        $inicio = microtime(true);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $fin = microtime(true);
        
        $tiempo_ejecucion = $fin - $inicio;
        echo "Tiempo de ejecución: " . number_format($tiempo_ejecucion, 4) . " segundos<br>";
        
        // Guardar el tiempo de ejecución en un archivo de monitoreo
        $log = date("Y-m-d H:i:s") . " | Tiempo de ejecución: " . $tiempo_ejecucion . " segundos\n";
        file_put_contents("log_monitoreo.txt", $log, FILE_APPEND);
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Consultas críticas para monitorear
$consultas = [
    "Consulta de productos por nombre y stock" => "
        SELECT id, nombre, precio, stock FROM productos WHERE nombre LIKE '%Laptop%' AND stock > 5
    ",
    "Consulta de ventas por cliente y estado" => "
        SELECT id, fecha_venta, total FROM ventas WHERE cliente_id = 1 AND estado = 'completada'
    "
];

foreach ($consultas as $descripcion => $sql) {
    echo "<h2>$descripcion</h2>";
    monitorearConsulta($pdo, $sql);
}

$pdo = null;
?>
