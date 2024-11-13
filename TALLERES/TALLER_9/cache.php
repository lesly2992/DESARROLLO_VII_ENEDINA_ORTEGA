<?php
class Cache {
    private $cacheDir;

    public function __construct($cacheDir = 'cache') {
        $this->cacheDir = $cacheDir;
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function get($key) {
        $file = $this->cacheDir . '/' . md5($key) . '.cache';
        if (file_exists($file) && (time() - filemtime($file) < 3600)) { // 1 hour cache
            return unserialize(file_get_contents($file));
        }
        return false;
    }

    public function set($key, $data) {
        $file = $this->cacheDir . '/' . md5($key) . '.cache';
        file_put_contents($file, serialize($data));
    }
}

// Ejemplo de uso
$cache = new Cache();
$key = 'popular_products_page_1';

if (!$products = $cache->get($key)) {
    // Generar resultados y almacenar en caché
    $paginator = new Paginator($pdo, 'productos', 10);
    $paginator->select('id', 'nombre', 'precio')->setPage(1);
    $products = $paginator->getResults();
    $cache->set($key, $products);
}

// Usar $products para mostrar los resultados
?>
