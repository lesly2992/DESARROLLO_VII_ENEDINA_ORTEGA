<?php
require 'includes/header.php';
require 'includes/funciones.php';

$libros = obtenerLibros();


foreach ($libros as $libro) {
    echo mostrarDetallesLibro($libro);
}

require 'includes/footer.php';
?>
