<?php
$nombre = "Juan Perez";
$longitud = strlen($nombre);

echo "El nombre '$nombre' tiene $longitud caracteres.";

$miNombre = "Enedina Ortega";
$longitudMiNombre= strlen($miNombre);
echo " Mi nombre completo tiene $longitudMiNombre caracteres.";


function categorizarLongitud($texto) {
    $longitud = strlen($texto);
    if ($longitud < 5) {
        return "corto";
    } elseif ($longitud <= 10) {
        return "medio";
    } else {
        return "largo";
    }
}

$categoria = categorizarLongitud($miNombre);
echo "</br>Mi nombre es considerado $categoria.";




?>