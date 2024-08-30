<?php
$frutas = ["Manzana", "Naranja", "Plátano", "Uva"];
$frase = implode(", ", $frutas);

echo "Array de frutas:</br>";
print_r($frutas);
echo "Frase creada: $frase</br>";

$paises=["Luxemburgo","Croacia","Viena","Corea","Egipto"];
$listaPaises= implode("-",$paises);

echo"</br> Mi lista de paises para visitar : $listaPaises</br>";


$persona = [
    "nombre" => "Juan",
    "edad" => 30,
    "ciudad" => "Madrid"
];

$infoPersona = implode(" | ", $persona);
echo "</br>Información de la persona: $infoPersona</br>";

$number=["1", "2", "3", "4", "5"];
$listaNumber= implode("*",$number);

echo"</br> Mi lista de paises para visitar : $listaNumber</br>";

?>