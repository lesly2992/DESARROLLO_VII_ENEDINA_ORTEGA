<?php
class Empleado {
    private $Nombre;
    private $ID_de_empleado;
    private $Salario_base;

    public function __construct($Nombre, $ID_de_empleado, $Salario_base) {
        $this->setNombre($Nombre);
        $this->setID_de_empleado($ID_de_empleado);
        $this->setSalario_base($Salario_base);
    }

    // Setters
    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setID_de_empleado($ID_de_empleado) {
        $this->ID_de_empleado = $ID_de_empleado;
    }

    public function setSalario_base($Salario_base) {
        $this->Salario_base = $Salario_base;
    }

    // Getters
    public function getNombre() {
        return $this->Nombre;
    }

    public function getID_de_empleado() {
        return $this->ID_de_empleado;
    }

    public function getSalario_base() {
        return $this->Salario_base;
    }

    // Método para obtener la información del empleado
    public function obtenerInformacion() {
        return "'{$this->getNombre()}' tiene el ID {$this->getID_de_empleado()} y un salario de {$this->getSalario_base()}";
    }
}

// Prueba de la clase
$empleados = new Empleado("Ana Herrera", "2507", 1000);
echo $empleados->obtenerInformacion();
echo "\nNombre: " . $empleados->getNombre();
