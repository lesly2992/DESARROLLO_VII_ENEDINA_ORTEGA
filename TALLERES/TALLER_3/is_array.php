<?php
$frutas = ["Manzana", "Naranja", "Plátano"];
$nombre = "Juan";
$edad = 25;

echo '¿$frutas es un array? ' . (is_array($frutas) ? "Sí" : "No") . "</br>";
echo '¿$nombre es un array? ' . (is_array($nombre) ? "Sí" : "No") . "</br>";
echo '¿$edad es un array? ' . (is_array($edad) ? "Sí" : "No") . "</br>";


$miArray = ["1", "2", "3", "4"];
$miString = "5";
$miNumero = 1;

echo "</br>Resultados del ejercicio:</br>";
echo '¿$miArray es un array? ' . (is_array($miArray) ? "Sí" : "No") . "</br>";
echo '¿$miString es un array? ' . (is_array($miString) ? "Sí" : "No") . "</br>";
echo '¿$miNumero es un array? ' . (is_array($miNumero) ? "Sí" : "No") . "</br>";

function procesarDato($dato) {
    if (is_array($dato)) {
        echo "El dato es un array. Contenido:</br>";
        print_r($dato);
    } else {
        echo "El dato no es un array. Valor: $dato</br>";
    }
}

echo "</br>Pruebas de la función procesarDato():</br>";
procesarDato([1, 2, 3]);
procesarDato("Hola mundo");
procesarDato(42);



?>