<?php
require_once 'Empresa.php';

$empresa = new Empresa();

$gerente = new Gerente("Carlos Pérez", "1001", 3000, "Ventas");
$desarrollador = new Desarrollador("Ana Herrera", "2507", 2000, "PHP", 7);

$gerente->asignarBono(500);

$empresa->agregarEmpleado($gerente);
$empresa->agregarEmpleado($desarrollador);


echo "Lista de empleados:" . PHP_EOL;
$empresa->listarEmpleados();

echo PHP_EOL . "Nómina total: " . $empresa->calcularNominaTotal() . PHP_EOL;

echo PHP_EOL . "Evaluaciones de desempeño:" . PHP_EOL;
$empresa->realizarEvaluaciones();
?>
