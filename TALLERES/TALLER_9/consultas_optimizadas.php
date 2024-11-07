<?php
require_once "config_pdo.php";

class ConsultasOptimizadas {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function buscarProductos($nombre, $stock_minimo) {
        $sql = "SELECT id, nombre, precio, stock
                FROM productos
                USE INDEX (idx_productos_nombre_stock)
                WHERE nombre LIKE :nombre AND stock > :stock_minimo";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => '%' . $nombre . '%',
            ':stock_minimo' => $stock_minimo
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function ventasPorClienteEstado($cliente_id, $estado) {
        $sql = "SELECT id, fecha_venta, total
                FROM ventas
                USE INDEX (idx_ventas_cliente_estado)
                WHERE cliente_id = :cliente_id AND estado = :estado";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':cliente_id' => $cliente_id,
            ':estado' => $estado
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Ejemplo de uso
$consultas = new ConsultasOptimizadas($pdo);

// Buscar productos por nombre y stock
$productos = $consultas->buscarProductos("Laptop", 5);
echo "<h3>Productos encontrados:</h3>";
print_r($productos);

// Consultar ventas por cliente y estado
$ventas = $consultas->ventasPorClienteEstado(1, 'completada');
echo "<h3>Ventas del cliente:</h3>";
print_r($ventas);

$pdo = null;
?>
