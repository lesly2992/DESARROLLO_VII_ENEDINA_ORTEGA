<?php
$jsonFrutas = '["manzana","banana","naranja"]';
$frutas = json_decode($jsonFrutas);
echo "JSON de frutas decodificado:</br>";
print_r($frutas);

$jsonPersona = '{"nombre":"Juan","edad":30,"ciudad":"Madrid"}';
$persona = json_decode($jsonPersona, true);
echo "</br>JSON de persona decodificado como array:</br>";
print_r($persona);


$jsonPelicula = '{"titulo":"Harry Potter","director":"No se ","año":1998,"actores":["Harry Potter","Ronald Wisley","Hermaiony Grenger"]}';
$peliculaFavorita = json_decode($jsonPelicula, true);
echo "</br>Información de tu película favorita decodificada:</br>";
print_r($peliculaFavorita);


$jsonComplejo = '{
    "nombre": "María",
    "edad": 28,
    "hobbies": ["leer", "nadar", "viajar"],
    "direccion": {
        "calle": "Calle Principal",
        "numero": 123,
        "ciudad": "Barcelona"
    }
}';
$datosComplejos = json_decode($jsonComplejo, true);
echo "</br>JSON complejo decodificado:</br>";
print_r($datosComplejos);


$jsonInvalido = '{"nombre": "Pedro", "edad": 35,}';
$resultado = json_decode($jsonInvalido);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "</br>Error al decodificar JSON: " . json_last_error_msg();
}
?>