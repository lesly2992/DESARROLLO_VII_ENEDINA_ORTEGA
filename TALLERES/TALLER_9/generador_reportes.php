<?php
require_once "config_pdo.php";
require_once "QueryBuilder.php";

function generarReporte($pdo, $campos, $filtros) {
    $qb = new QueryBuilder($pdo);
    $qb->table('ventas v')
       ->select($campos)
       ->join('clientes c', 'v.cliente_id', '=', 'c.id');

    if (isset($filtros['fecha_inicio'])) {
        $qb->where('v.fecha', '>=', $filtros['fecha_inicio']);
    }

    if (isset($filtros['fecha_fin'])) {
        $qb->where('v.fecha', '<=', $filtros['fecha_fin']);
    }

    if (isset($filtros['monto_min'])) {
        $qb->where('v.total', '>=', $filtros['monto_min']);
    }

    if (isset($filtros['cliente_id'])) {
        $qb->where('c.id', '=', $filtros['cliente_id']);
    }

    if (isset($filtros['limite'])) {
        $qb->limit($filtros['limite'], $filtros['offset'] ?? 0);
    }

    return $qb->execute();
}

// Ejemplo de uso
$campos = ['v.id', 'v.total', 'v.fecha', 'c.nombre as cliente'];
$filtros = [
    'fecha_inicio' => '2024-01-01',
    'fecha_fin' => '2024-12-31',
    'monto_min' => 500,
    'cliente_id' => 3,
    'limite' => 10
];
$reportes = generarReporte($pdo, $campos, $filtros);
echo "<pre>";
print_r($reportes);
echo "</pre>";
?>
