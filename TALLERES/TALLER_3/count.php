<?php
$frutas = ["Manzana", "Naranja", "Plátano", "Uva", "Pera"];
$numFrutas = count($frutas);

echo "Array de frutas:</br>";
print_r($frutas);
echo "Número de frutas: $numFrutas</br>";

$misCanciones = ["Die with a smile", "9 to 5", "bridgh of light", "End Of Beginning","Somebody To love"];
$numCanciones = count($misCanciones);

echo "</br>Número de canciones en mi lista: $numCanciones</br>";

$playlist = [
    "Rock" => ["Bohemian Rhapsody", "Stairway to Heaven"],
    "Pop" => ["Thriller", "Billie Jean", "Beat It"],
    "Jazz" => ["Take Five", "So What"]
];

$totalCanciones = 0;
foreach ($playlist as $genero => $canciones) {
    $numCancionesGenero = count($canciones);
    $totalCanciones += $numCancionesGenero;
    echo "Canciones de $genero: $numCancionesGenero</br>";
}

echo "Total de canciones en la playlist: $totalCanciones</br>";

?>