<?php
require_once "config_pdo.php";
require_once "QueryBuilder.php"; // Clase QueryBuilder del código anterior

function filtrarProductos($pdo, $criterios) {
    $qb = new QueryBuilder($pdo);
    $qb->table('productos p')
       ->select('p.id', 'p.nombre', 'p.precio', 'p.disponibilidad', 'c.nombre as categoria')
       ->join('categorias c', 'p.categoria_id', '=', 'c.id');

    if (isset($criterios['precio_min'])) {
        $qb->where('p.precio', '>=', $criterios['precio_min']);
    }

    if (isset($criterios['precio_max'])) {
        $qb->where('p.precio', '<=', $criterios['precio_max']);
    }

    if (isset($criterios['categoria'])) {
        $qb->where('c.id', '=', $criterios['categoria']);
    }

    if (isset($criterios['disponibilidad'])) {
        $qb->where('p.disponibilidad', '=', $criterios['disponibilidad']);
    }

    if (isset($criterios['ordenar_por'])) {
        $qb->orderBy($criterios['ordenar_por'], $criterios['orden'] ?? 'ASC');
    }

    if (isset($criterios['limite'])) {
        $qb->limit($criterios['limite'], $criterios['offset'] ?? 0);
    }

    return $qb->execute();
}

// Ejemplo de uso
$criterios = [
    'precio_min' => 100,
    'precio_max' => 1000,
    'categoria' => 2,
    'disponibilidad' => 1,
    'ordenar_por' => 'p.precio',
    'orden' => 'ASC',
    'limite' => 10
];
$resultados = filtrarProductos($pdo, $criterios);
echo "<pre>";
print_r($resultados);
echo "</pre>";
?>
