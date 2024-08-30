<?php

$frase= "Manzana, Naranja, Platano, Uva";
$frutas= explode(",", $frase);

echo "Frase original: $frase </br>";
echo "Array de frutos:</br>";
print_r($frutas);

//Mis peliculas
$misPeliculas= "Harry Potter - El señor de los anillos - Avenger's - Legalmente rubia - Historias Cruzadas";
$arrayPeliculas= explode("-", $misPeliculas);//explode("caracter con el que se va a separ el array",$variable de datos)

echo "</br> Mis Peliculas favoritas:</br>";
print_r($arrayPeliculas);

$texto = "Uno, Dos, Tres, Cuatro, Cinco";
$array= explode(",", $texto, 3);//explode("caracter con el que se va a separ el array",$variable de datos,limite)

echo"</br> Texto Original: $texto</br>";
echo "Array con límite:</br>";
print_r($array);




?>