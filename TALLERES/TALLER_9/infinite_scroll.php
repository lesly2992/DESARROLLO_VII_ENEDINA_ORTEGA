<?php
require_once "config_pdo.php";
require_once "Paginator.php"; // Clase Paginator del código anterior

$perPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$paginator = new Paginator($pdo, 'productos', $perPage);
$paginator->select('id', 'nombre', 'precio')
          ->setPage($page);

$results = $paginator->getResults();
$pageInfo = $paginator->getPageInfo();

header('Content-Type: application/json');
echo json_encode([
    'results' => $results,
    'has_next' => $pageInfo['has_next'],
    'next_page' => $pageInfo['next_page']
]);
?>
