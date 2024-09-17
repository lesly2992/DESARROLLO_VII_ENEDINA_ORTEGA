
<?php
echo "Fecha actual: " . date("Y-m-d") . "</br>";
echo "Hora actual: " . date("H:i:s") . "</br>";
echo "Fecha y hora actuales: " . date("Y-m-d H:i:s") . "</br>";

$fechaFormateada = date("D-m-y");
echo "Fecha formateada: $fechaFormateada</br>";


function diasEntre($fecha1, $fecha2) {
    $timestamp1 = strtotime($fecha1);
    $timestamp2 = strtotime($fecha2);
    $diferencia = abs($timestamp2 - $timestamp1);
    return floor($diferencia / (60 * 60 * 24));
}

$fechaInicio = "2023-01-01";
$fechaFin = date("Y-m-d"); // Fecha actual
$diasTranscurridos = diasEntre($fechaInicio, $fechaFin);

echo "</br>Días transcurridos desde el $fechaInicio hasta hoy: $diasTranscurridos días</br>";

echo "</br>Zona horaria actual: " . date_default_timezone_get() . "</br>";

date_default_timezone_set("America/New_York");
echo "Hora en New York: " . date("H:i:s") . "</br>";
?>
      
