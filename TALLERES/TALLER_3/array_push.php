<?php
$frutas = ["Manzana", "Naranja", "Plátano"];
echo "Array original de frutas:</br>";
print_r($frutas);

array_push($frutas, "Uva", "Pera");
echo "</br>Array de frutas después de array_push():</br>";
print_r($frutas);

$misAmigos = ["Yusbielis","Jeannine","Brigitte"];
array_push($misAmigos, "Yelsis", "Maybelis");

echo "</br>Mi lista de amigos:</br>";
print_r($misAmigos);

$playlist = [
    ["Bohemian Rhapsody", "Queen"],
    ["Imagine", "John Lennon"]
];
array_push($playlist, ["Billie Jean", "Michael Jackson"], ["Like a Rolling Stone", "Bob Dylan"]);

echo "</br>Mi playlist:</br>";
foreach ($playlist as $cancion) {
    echo "- {$cancion[0]} por {$cancion[1]}</br>";



?>