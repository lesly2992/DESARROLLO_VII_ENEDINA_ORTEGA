<?php
//contar_palabras($texto): Recibe una cadena de texto y devuelve el número de palabras en el texto.

echo "Las palabras son: ";
function contar_palabras($texto){
    echo "<br>";
    for ($i= 0; $i < count($texto); $i++){
    echo($i + 1). "." . $texto[$i]. "<br>";
}
}

$texto= ["Estamos", "aprendiendo", "PHP"];
contar_palabras($texto);;



//contar_vocales($texto): Recibe una cadena de texto y devuelve el número de vocales (a, e, i, o, u, sin distinguir entre mayúsculas y minúsculas).

echo "<br>";
echo "vocales:  " . "<br>";
$vocales= ["a", "e", "i", "o", "u"];
function contar_vocales($vocales){
    for ($i = 0; $i < count($vocales); $i++){
    echo ($i + 1) . ". " . $vocales[$i] . "<br>";
}
}
contar_vocales($vocales);





$palabras= ["Hola" ,"mundo"];
echo "<br>";
function invertir_palabras($palabras){
    $listPalabras =  explode(" ",$palabras);
    krsort($listPalabras);
    $nuevoTexto = implode(" ",$listPalabras);
    return $nuevoTexto;
  }


?>