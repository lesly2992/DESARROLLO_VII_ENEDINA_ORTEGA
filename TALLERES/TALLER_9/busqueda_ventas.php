<?php
require_once "config_pdo.php";
require_once "QueryBuilder.php";

function buscarVentas($pdo, $criterios) {
    $qb = new QueryBuilder($pdo);
    $qb->table('ventas v')
       ->select('v.id', 'v.total', 'v.fecha', 'c.nombre as cliente', 'p.nombre as producto')
       ->join('clientes c', 'v.cliente_id', '=', 'c.id')
       ->join('detalles_venta dv', 'v.id', '=', 'dv.venta_id')
       ->join('productos p', 'dv.producto_id', '=', 'p.id');

    if (isset($criterios['fecha_inicio'])) {
        $qb->where('v.fecha', '>=', $criterios['fecha_inicio']);
    }

    if (isset($criterios['fecha_fin'])) {
        $qb->where('v.fecha', '<=', $criterios['fecha_fin']);
    }

    if (isset($criterios['cliente_id'])) {
        $qb->where('c.id', '=', $criterios['cliente_id']);
    }

    if (isset($criterios['monto_min'])) {
        $qb->where('v.total', '>=', $criterios['monto_min']);
    }

    if (isset($criterios['producto_id'])) {
        $qb->where('p.id', '=', $criterios['producto_id']);
    }

    return $qb->execute();
}

// Ejemplo de uso
$criterios = [
    'fecha_inicio' => '2024-01-01',
    'fecha_fin' => '2024-12-31',
    'cliente_id' => 1,
    'monto_min' => 1000,
    'producto_id' => 2
];
$ventas = buscarVentas($pdo, $criterios);
echo "<pre>";
print_r($ventas);
echo "</pre>";
?>
