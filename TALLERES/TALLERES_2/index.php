
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

                    

?>
                        
