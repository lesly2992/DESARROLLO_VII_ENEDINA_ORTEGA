<?php
require_once "config_pdo.php";

class PedidoManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function procesarPedido($cliente_id, $items) {
        try {
            $this->pdo->beginTransaction();
            
            $stmt = $this->pdo->prepare("INSERT INTO pedidos (cliente_id, total) VALUES (?, 0)");
            $stmt->execute([$cliente_id]);
            $pedido_id = $this->pdo->lastInsertId();

            $this->pdo->exec("SAVEPOINT pedido_creado");

            $total_pedido = 0;
            foreach ($items as $index => $item) {
                try {
                    // Verificar stock
                    $stmt = $this->pdo->prepare("SELECT stock, precio FROM productos WHERE id = ? FOR UPDATE");
                    $stmt->execute([$item['producto_id']]);
                    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($producto['stock'] < $item['cantidad']) {
                        throw new Exception("Stock insuficiente para producto {$item['producto_id']}");
                    }

                    $this->pdo->exec("SAVEPOINT item_$index");

                    // Actualizar stock y registrar detalle de pedido
                    $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
                    $stmt->execute([$item['cantidad'], $item['producto_id']]);
                    
                    $subtotal = $producto['precio'] * $item['cantidad'];
                    $stmt = $this->pdo->prepare("INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$pedido_id, $item['producto_id'], $item['cantidad'], $producto['precio'], $subtotal]);

                    $total_pedido += $subtotal;
                    
                } catch (Exception $e) {
                    $this->pdo->exec("ROLLBACK TO SAVEPOINT item_$index");
                    echo "Error procesando item: " . $e->getMessage() . "<br>";
                    continue;
                }
            }

            // Actualizar total del pedido
            $stmt = $this->pdo->prepare("UPDATE pedidos SET total = ? WHERE id = ?");
            $stmt->execute([$total_pedido, $pedido_id]);

            $this->pdo->commit();
            echo "Pedido procesado exitosamente<br>";

        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Error en la transacción: " . $e->getMessage();
        }
    }
}
?>
