<?php
require_once "config_mysqli.php";

// 1. Mostrar las últimas 5 publicaciones con autor y fecha
$sql = "SELECT p.titulo, u.nombre AS autor, p.fecha_publicacion 
        FROM publicaciones p 
        INNER JOIN usuarios u ON p.usuario_id = u.id 
        ORDER BY p.fecha_publicacion DESC 
        LIMIT 5";
$result = mysqli_query($conn, $sql);

echo "<h3>Últimas 5 publicaciones:</h3>";
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
} else {
    echo "No hay publicaciones recientes.";
}
mysqli_free_result($result);

// 2. Listar usuarios sin publicaciones
$sql = "SELECT u.nombre 
        FROM usuarios u 
        LEFT JOIN publicaciones p ON u.id = p.usuario_id 
        WHERE p.id IS NULL";
$result = mysqli_query($conn, $sql);

echo "<h3>Usuarios sin publicaciones:</h3>";
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Usuario: " . $row['nombre'] . "<br>";
    }
} else {
    echo "Todos los usuarios han publicado al menos una vez.";
}
mysqli_free_result($result);

// 3. Promedio de publicaciones por usuario
$sql = "SELECT AVG(num_publicaciones) AS promedio 
        FROM (SELECT COUNT(p.id) AS num_publicaciones 
              FROM usuarios u 
              LEFT JOIN publicaciones p ON u.id = p.usuario_id 
              GROUP BY u.id) AS subquery";
$result = mysqli_query($conn, $sql);

echo "<h3>Promedio de publicaciones por usuario:</h3>";
if ($row = mysqli_fetch_assoc($result)) {
    echo "Promedio: " . $row['promedio'];
}
mysqli_free_result($result);

// 4. Publicación más reciente de cada usuario
$sql = "SELECT u.nombre, p.titulo, MAX(p.fecha_publicacion) AS fecha 
        FROM publicaciones p 
        INNER JOIN usuarios u ON p.usuario_id = u.id 
        GROUP BY u.id";
$result = mysqli_query($conn, $sql);

echo "<h3>Publicación más reciente de cada usuario:</h3>";
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Usuario: " . $row['nombre'] . ", Título: " . $row['titulo'] . ", Fecha: " . $row['fecha'] . "<br>";
    }
} else {
    echo "No hay publicaciones.";
}
mysqli_free_result($result);

mysqli_close($conn);
?>
