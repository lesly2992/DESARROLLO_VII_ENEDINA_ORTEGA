<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "{$producto['nombre']} - ${$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "\n";
    }
}

echo "Productos de {$tiendaData['tienda']}:\n";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "\nValor total del inventario: $$valorTotal\n";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "\nProducto más caro: {$productoMasCaro['nombre']} (${$productoMasCaro['precio']})\n";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDe

Computadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "\nProductos en la categoría 'computadoras':\n";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "\nDatos actualizados de la tienda (JSON):\n$jsonActualizado\n";

// TAREA: Implementa una función que genere un resumen de ventas
// Arreglo de ventas: producto_id, cliente_id, cantidad, fecha
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2023-09-01"],
    ["producto_id" => 3, "cliente_id" => 102, "cantidad" => 2, "fecha" => "2023-09-02"],
    ["producto_id" => 2, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2023-09-02"],
    ["producto_id" => 1, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2023-09-03"],
    ["producto_id" => 4, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2023-09-04"]
 ];
 // Función para generar el resumen de ventas
 function generarResumenVentas($ventas, $productos, $clientes) {
    // Variables para almacenar el resumen
    $totalVentas = 0;
    $productosVendidos = [];
    $clientesCompras = [];
    // Recorrer todas las ventas
    foreach ($ventas as $venta) {
        $totalVentas += $venta['cantidad']; // Sumar la cantidad vendida
        // Contar productos vendidos
        if (!isset($productosVendidos[$venta['producto_id']])) {
            $productosVendidos[$venta['producto_id']] = 0;
        }
        $productosVendidos[$venta['producto_id']] += $venta['cantidad'];
        // Contar compras por cliente
        if (!isset($clientesCompras[$venta['cliente_id']])) {
            $clientesCompras[$venta['cliente_id']] = 0;
        }
        $clientesCompras[$venta['cliente_id']] += $venta['cantidad'];
    }
    // Encontrar el producto más vendido
    $productoMasVendidoId = array_keys($productosVendidos, max($productosVendidos))[0];
    $productoMasVendido = array_filter($productos, function($producto) use ($productoMasVendidoId) {
        return $producto['id'] == $productoMasVendidoId;
    });
    $productoMasVendido = array_values($productoMasVendido)[0]; // Obtener el primer resultado
    // Encontrar el cliente que más ha comprado
    $clienteMayorComprasId = array_keys($clientesCompras, max($clientesCompras))[0];
    $clienteMayorCompras = array_filter($clientes, function($cliente) use ($clienteMayorComprasId) {
        return $cliente['id'] == $clienteMayorComprasId;
    });
    $clienteMayorCompras = array_values($clienteMayorCompras)[0]; // Obtener el primer resultado
    // Retornar el resumen
    return [
        'total_ventas' => $totalVentas,
        'producto_mas_vendido' => $productoMasVendido['nombre'],
        'cliente_mayor_compras' => $clienteMayorCompras['nombre']
    ];
 }
 // Generar el resumen de ventas
 $resumen = generarResumenVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);
 // Mostrar el resumen de ventas
 echo "\nResumen de ventas:\n";
 echo "Total de ventas: {$resumen['total_ventas']}\n";
 echo "Producto más vendido: {$resumen['producto_mas_vendido']}\n";
 echo "Cliente que más ha comprado: {$resumen['cliente_mayor_compras']}\n";

?>
