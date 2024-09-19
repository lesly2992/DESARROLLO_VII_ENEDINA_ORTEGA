<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';


class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono;

    public function __construct($Nombre, $ID_de_empleado, $Salario_base, $departamento) {
        parent::__construct($Nombre, $ID_de_empleado, $Salario_base);
        $this->departamento = $departamento;
        $this->bono = 0;
    }

    // Setters y getters
    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function asignarBono($bono) {
        $this->bono = $bono;
    }

    public function getBono() {
        return $this->bono;
    }

    // Implementación del método evaluarDesempenio de la interfaz
    public function evaluarDesempenio() {
        // Lógica para evaluar el desempeño del gerente
        if ($this->bono > 0) {
            return "El gerente ha tenido un buen desempeño, bono asignado: {$this->bono}";
        }
        return "El gerente no ha tenido un buen desempeño, bono no asignado.";
    }

    public function obtenerInformacion() {
        return parent::obtenerInformacion() . " y es gerente del departamento de {$this->getDepartamento()}";
    }
}
?>
