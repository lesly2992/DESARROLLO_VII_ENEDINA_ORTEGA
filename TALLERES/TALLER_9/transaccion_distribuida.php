<?php
require_once "config_pdo.php";

class TransaccionDistribuidaManager {
    private $pdo;

    public function realizarTransaccionDistribuida($cliente_id, $producto_id, $cantidad) {
        try {
            $this->pdo->beginTransaction();

            // Insertar pedido
            $stmt = $this->pdo->prepare("INSERT INTO pedidos (cliente_id, total) VALUES (?, 0)");
            $stmt->execute([$cliente_id]);
            $pedido_id = $this->pdo->lastInsertId();

            // Verificar stock del producto
            $stmt = $this->pdo->prepare("SELECT stock, precio FROM productos WHERE id = ? FOR UPDATE");
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($producto['stock'] < $cantidad) {
                throw new Exception("Stock insuficiente");
            }

            $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
            $stmt->execute([$cantidad, $producto_id]);

            $subtotal = $producto['precio'] * $cantidad;
            $stmt = $this->pdo->prepare("INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$pedido_id, $producto_id, $cantidad, $producto['precio'], $subtotal]);

            $stmt = $this->pdo->prepare("UPDATE pedidos SET total = ? WHERE id = ?");
            $stmt->execute([$subtotal, $pedido_id]);

            $this->pdo->commit();
            echo "Transacción distribuida completada exitosamente<br>";

        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Error en la transacción distribuida: " . $e->getMessage();
        }
    }
}
?>
