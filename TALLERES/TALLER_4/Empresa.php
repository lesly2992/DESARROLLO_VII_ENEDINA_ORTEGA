<?php
require_once 'Gerente.php';
require_once 'Desarrollador.php';

class Empresa {
    private $empleados = [];

    public function agregarEmpleado(Empleado $empleado) {
        $this->empleados[] = $empleado;
    }

    public function listarEmpleados() {
        foreach ($this->empleados as $empleado) {
            echo $empleado->obtenerInformacion() . PHP_EOL;
        }
    }

    public function calcularNominaTotal() {
        $nominaTotal = 0;
        foreach ($this->empleados as $empleado) {
            $nominaTotal += $empleado->getSalario_base();
        }
        return $nominaTotal;
    }

    public function realizarEvaluaciones() {
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                echo $empleado->evaluarDesempenio() . PHP_EOL;
            } else {
                echo "{$empleado->getNombre()} no es evaluable." . PHP_EOL;
            }
        }
    }
}
?>
