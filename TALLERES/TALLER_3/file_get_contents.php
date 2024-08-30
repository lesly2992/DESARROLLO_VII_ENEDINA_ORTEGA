
<?php
$contenidoArchivo = file_get_contents("ejemplo.txt");
echo "Contenido del archivo ejemplo.txt:</br>$contenidoArchivo</br>";

$nombreArchivo = "strlen.php";
$contenidoPhp = file_get_contents($nombreArchivo);
echo "</br>Contenido del archivo $nombreArchivo:</br>$contenidoPhp</br>";

$url = "https://www.php.net";
$contenidoWeb = file_get_contents($url);
echo "</br>Contenido de $url:</br>" . substr($contenidoWeb, 0, 500) . "...</br>";

$archivoInexistente = "archivo_que_no_existe.txt";
$contenido = @file_get_contents($archivoInexistente); 

if ($contenido === false) {
    echo "</br>Error: No se pudo leer el archivo '$archivoInexistente'.</br>";
} else {
    echo "</br>Contenido del archivo '$archivoInexistente':</br>$contenido</br>";
}
?>
      
