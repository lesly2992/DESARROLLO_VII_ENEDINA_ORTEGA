<?php

$frase = "El gato negro salto sobre el perro negro";
$fraseModificada = str_replace("negro","blanco", $frase);

echo "Frase original: $frase </br>";
echo "Frase modificada: $fraseModificada</br>";

$miFrase= "Mi lenguaje favorito es PHP, aprender PHP es muy bueno para crear paginas Web ya que PHP es muy utilizado en paginas webs dinamicas";
$miFraseModificada= str_replace("PHP", "JavaScript", $miFrase);// str_replace("la palabra a reemplazar","la palabra por la que se va a remplazar", $la variable que contiene esa palabra o frase)

echo "</br> Mi frase originar: $miFrase</br>";
echo "Mi frase modificada: $miFraseModificada</br>";

$texto = "Manzanas y naranjas son frutas. Me gustan las manzanas y las naranjas.";
$buscar = ["Manzanas", "naranjas"];
$reemplazar = ["Peras", "uvas"];
$textoModificado = str_replace($buscar, $reemplazar, $texto);

echo "</br>Texto original: $texto</br>";
echo "Texto modificado: $textoModificado</br>";

$palabras = "Los paises que quiero visitar son Paris, Francia, Noruega";
$search= ["Paris","Francia","Noruega"];
$replace= ["Luxemburgo", "Croacia", "Viena"];
$textoModificado1= str_replace($search, $replace, $palabras);

echo "</br> original:$palabras";
echo "</br> modificacion:$textoModificado1";

?>