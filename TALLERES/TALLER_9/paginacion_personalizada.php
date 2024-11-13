<?php
require_once "config_pdo.php";
require_once "Paginator.php";

$perPageOptions = [5, 10, 20, 50];
$perPage = isset($_GET['per_page']) && in_array($_GET['per_page'], $perPageOptions) ? (int)$_GET['per_page'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$paginator = new Paginator($pdo, 'productos', $perPage);
$paginator->select('id', 'nombre', 'precio')
          ->setPage($page);

$results = $paginator->getResults();
$pageInfo = $paginator->getPageInfo();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Paginación Personalizada</title>
</head>
<body>
    <form method="GET" action="paginacion_personalizada.php">
        <label for="per_page">Elementos por página:</label>
        <select name="per_page" id="per_page" onchange="this.form.submit()">
            <?php foreach ($perPageOptions as $option): ?>
                <option value="<?= $option ?>" <?= $perPage == $option ? 'selected' : '' ?>><?= $option ?></option>
            <?php endforeach; ?>
        </select>
    </form>

    <div id="product-list">
        <?php foreach ($results as $product): ?>
            <div class="product">
                <h3><?= htmlspecialchars($product['nombre']) ?></h3>
                <p>Precio: $<?= number_format($product['precio'], 2) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Código de paginación similar al HTML de ejemplo -->
</body>
</html>
