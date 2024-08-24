<?php
$nombre_completo = "Enedina Ortega";
$edad = "23";
$correo = "leslyortg29@gmail.com";
$telefono = "6843-3988";
$ocupacion = "Estudiante";


define("NOMBRE_CONSTANTE", "Usuario de Perfil");
define("MI_CONSTANTE", "Valor de constante");

echo "Hola, mi nombre es " . $nombre_completo . ".<br>"; 
print "Tengo " . $edad . " años.<br>";
printf("Puedes contactarme en: %s.<br>", $correo);
echo "Mi número de teléfono es: ", $telefono, ".<br>";
print "Actualmente, soy una " . $ocupacion . ".<br>";


echo "Este mensaje es mostrado usando la constante: " . NOMBRE_CONSTANTE . ".<br>";
echo "Además, aquí hay otro valor constante: " . MI_CONSTANTE . ".<br>";

var_dump($nombre_completo);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump($ocupacion);
echo "<br>";
var_dump(NOMBRE_CONSTANTE);
echo "<br>";
var_dump(MI_CONSTANTE);
?>