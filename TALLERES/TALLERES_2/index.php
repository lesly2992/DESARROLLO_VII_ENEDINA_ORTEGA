
<?php
echo "Hola, mundo! <br>";


$nombre = "Juan";
$edad = 25;
$altura = 1.75;
$esEstudiante = true;

echo "Nombre: $nombre <br>";
echo "Edad: $edad <br>";
echo "Altura: $altura <br>";
echo "Es esutudiante?"  . ($esEstudiante ? "SI" : "NO"); 


echo "<br>";
echo "<br>";


$presentacion1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";
$presentacion2 = "Hola, mi nombre es $nombre y tengo $edad años.";
define("SALUDO", "¡Bienvenido!"); 

$mensaje = SALUDO . " " . $nombre;

echo $presentacion1 . "<br>";
echo $presentacion2 . "<br>";
echo $mensaje . "<br>";

echo "<br>";
echo "<br>";



echo "<br>";

echo "Hola, mundo!<br>";
echo "Mi nombre es $nombre<br>";

print "Tengo $edad años<br>";

printf("Me llamo %s y tengo %d años<br>", $nombre, $edad);

var_dump($nombre);
echo "<br>";


echo"<br>";
$nombre = "María";
$edad = 30;
$ciudad = "Madrid";

define("PROFESION", "Ingeniera");

$mensaje1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";
$mensaje2 = "Vivo en $ciudad y soy " . PROFESION . ".";

echo $mensaje1 . "<br>";
print($mensaje2 . "<br>");

printf("En resumen: %s, %d años, %s, %s<br>", $nombre, $edad, $ciudad, PROFESION);

echo "<br>Información de debugging:<br>";
var_dump($nombre);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($ciudad);
echo "<br>";
var_dump(PROFESION);
echo "<br>";
                    

?>
                        
