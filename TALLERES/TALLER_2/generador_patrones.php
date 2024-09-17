<?php
echo "Patrón de triángulo rectángulo:<br>";
echo "<br>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>"; 
}

echo "<br>"; 

echo "Números impares del 1 al 20:<br>";
$num = 1;
while ($num <= 20) {
    if ($num % 2 != 0) {
        echo $num . "<br>";
    }
    $num++;
}

echo "<br>";

echo "Contador regresivo desde 10 hasta 1, saltando el número 5:<br>";
$contador = 10;
do {
    if ($contador != 5) {
        echo $contador . "<br>";
    }
    $contador--;
} while ($contador >= 1);

?>
