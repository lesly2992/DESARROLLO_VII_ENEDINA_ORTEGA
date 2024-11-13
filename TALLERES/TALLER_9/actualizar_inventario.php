<?php
require_once "config_pdo.php";

class InventarioManager {
    private $pdo;
    
    public function actualizarInventario($producto_id, $cantidad) {
        try {
            $this->pdo->beginTransaction();

            // Bloquear fila específica para actualización concurrente
            $stmt = $this->pdo->prepare("SELECT stock FROM productos WHERE id = ? FOR UPDATE");
            $stmt->execute([$producto_id]);
            $stock_actual = $stmt->fetchColumn();
            
            if ($stock_actual < $cantidad) {
                throw new Exception("Stock insuficiente");
            }

            // Actualizar el stock
            $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
            $stmt->execute([$cantidad, $producto_id]);

            $this->pdo->commit();
            echo "Inventario actualizado exitosamente<br>";

        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Error en la actualización de inventario: " . $e->getMessage();
        }
    }
}
?>
