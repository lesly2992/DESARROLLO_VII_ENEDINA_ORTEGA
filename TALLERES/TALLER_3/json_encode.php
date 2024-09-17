<?php
$frutas = ["manzana", "banana", "naranja"];
$jsonFrutas = json_encode($frutas);
echo "Array de frutas en JSON:</br>$jsonFrutas</br>";

$persona = [
    "nombre" => "Juan",
    "edad" => 30,
    "ciudad" => "Madrid"
];
$jsonPersona = json_encode($persona);
echo "</br>Array asociativo de persona en JSON:</br>$jsonPersona</br>";

// Ejercicio: Crea un array con información sobre tu película favorita
// (título, director, año, actores principales) y conviértelo a JSON
$peliculaFavorita = [
    "titulo" => "Harry Potter",
    "director" => "No se ",
    "year" => 1998,
    "actores" => ["Harry Potter", "Hermeony Greenger", "Ronald Wesly"]
];
$jsonPelicula = json_encode($peliculaFavorita);
echo "</br>Información de tu película favorita en JSON:</br>$jsonPelicula</br>";

class Libro {
    public $titulo;
    public $autor;
    public $año;
    
    public function __construct($titulo, $autor, $año) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->año = $año;
    }
}

$miLibro = new Libro("Cien year de soledad", "Gabriel García Márquez", 1967);
$jsonLibro = json_encode($miLibro);
echo "</br>Objeto Libro en JSON:</br>$jsonLibro</br>";

$datosConCaracteresEspeciales = [
    "nombre" => "María José",
    "descripción" => "Le gusta el café y el té"
];
$jsonConOpciones = json_encode($datosConCaracteresEspeciales, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo "</br>JSON con opciones (caracteres Unicode y formato bonito):</br>$jsonConOpciones</br>";
?>
      
