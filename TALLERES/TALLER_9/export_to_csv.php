<?php
require_once "config_pdo.php";
require_once "Paginator.php";

$perPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$paginator = new Paginator($pdo, 'productos', $perPage);
$paginator->select('id', 'nombre', 'precio')
          ->setPage($page);

$results = $paginator->getResults();

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=productos_pagina_' . $page . '.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Nombre', 'Precio']);

foreach ($results as $row) {
    fputcsv($output, [$row['id'], $row['nombre'], $row['precio']]);
}

fclose($output);
?>
