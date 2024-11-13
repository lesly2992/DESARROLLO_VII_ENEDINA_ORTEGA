<?php
require_once "config_pdo.php";
require_once "UpdateBuilder.php";

function actualizacionMasiva($pdo, $criterios, $nuevosValores) {
    $update = new UpdateBuilder($pdo);
    $update->table('productos')->set($nuevosValores);

    if (isset($criterios['categoria_id'])) {
        $update->where('categoria_id', '=', $criterios['categoria_id']);
    }

    if (isset($criterios['precio_min'])) {
        $update->where('precio', '>=', $criterios['precio_min']);
    }

    if (isset($criterios['precio_max'])) {
        $update->where('precio', '<=', $criterios['precio_max']);
    }

    return $update->execute();
}

// Ejemplo de uso
$criterios = [
    'categoria_id' => 2,
    'precio_min' => 100
];
$nuevosValores = [
    'disponibilidad' => 0 // Deshabilitar productos en esta categoría con precio mayor a 100
];
$actualizado = actualizacionMasiva($pdo, $criterios, $nuevosValores);

echo $actualizado ? "Actualización masiva exitosa<br>" : "Error en la actualización masiva<br>";
?>
