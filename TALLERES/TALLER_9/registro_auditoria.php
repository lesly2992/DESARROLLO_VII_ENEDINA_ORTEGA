<?php
require_once "config_pdo.php";

class AuditoriaManager {
    private $pdo;

    public function registrarFalloTransaccion($descripcion, $detalles) {
        $stmt = $this->pdo->prepare("INSERT INTO auditoria (descripcion, detalles, fecha) VALUES (?, ?, NOW())");
        $stmt->execute([$descripcion, $detalles]);
        echo "Registro de auditoría creado<br>";
    }
}

// Ejemplo de uso dentro de otra transacción fallida
try {
    // Simulación de transacción
    throw new Exception("Error en la transacción de ejemplo");
} catch (Exception $e) {
    $auditoria = new AuditoriaManager($pdo);
    $auditoria->registrarFalloTransaccion("Transacción fallida", $e->getMessage());
}
?>
